<?php

namespace App\Http\Controllers;

use App\Models\Produk;

use Illuminate\View\View;

use Illuminate\Http\RedirectResponse;

use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index(): View
    {
        $produks = Produk::latest()->paginate(5);

        return view('produks.index', compact('produks'));
    }

    public function create(): View
    {
        return view('produks.create');
    }

    public function store(Request $request): RedirectResponse
    {
        // buat validasi form
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,jpg,png,webp,avif|max:2048',
            'nama_produk' => 'required|min:5',
            'harga' => 'required|min:5',
            'deskripsi' => 'required|min:5'
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/produks', $image->hashName());

        //create post
        Produk::create([
            'image'     => $image->hashName(),
            'nama_produk'     => $request->nama_produk,
            'harga'   => $request->harga,
            'deskripsi'   => $request->deskripsi
        ]);

        return redirect()->route('produks.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function show(string $id): View
    {
        $produk = Produk::findOrFail($id);

        return view('produks.show', compact('produk'));
    }

    public function edit(string $id): View
    {
        //get post by ID
        $produk = Produk::findOrFail($id);

        //render view with post
        return view('produks.edit', compact('produk'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'image'     => 'image|mimes:jpeg,jpg,png|max:2048',
            'nama_produk'     => 'required|min:5',
            'harga'     => 'required|min:5',
            'deskripsi'   => 'required|min:5'
        ]);

        //get post by ID
        $produk = Produk::findOrFail($id);

        //check if image is uploaded
        if ($request->hasFile('image')) {

            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/produks', $image->hashName());

            //delete old image
            Storage::delete('public/produks/'.$produk->image);

            //update post with new image
            $produk->update([
                'image'     => $image->hashName(),
                'nama_produk'     => $request->nama_produk,
                'harga'     => $request->harga,
                'deskripsi'   => $request->deskripsi
            ]);

        } else {

            //update post without image
            $produk->update([
                'nama_produk'     => $request->nama_produk,
                'harga'     => $request->harga,
                'deskripsi'   => $request->deskripsi
            ]);
        }

        //redirect to index
        return redirect()->route('produks.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id): RedirectResponse
    {
        $produk = Produk::findOrFail($id);

        // hapus gambar
        Storage::delete('public/produks/'. $produk->image);

        $produk->delete();

        return redirect()->route('produks.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function home(): View
    {
        //get posts
        $produks = Produk::latest()->paginate(8);

        //render view with posts
        return view('produks.home', compact('produks'));
    }
}
