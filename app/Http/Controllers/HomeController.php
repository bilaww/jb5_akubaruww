<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\View\View;

use App\Models\Produk;

class HomeController extends Controller
{
    public function index(): View
    {
        //get posts
        $produks = Produk::latest()->paginate(8);

        //render view with posts
        return view('produks.home', compact('produks'));
    }
    public function show(string $id): View
    {
        //get post by ID
        $produk = Produk::findOrFail($id);

        //render view with post
        return view('home.show', compact('produk'));
    }
}
