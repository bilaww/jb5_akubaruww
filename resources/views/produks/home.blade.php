<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Data Produk - (nama web)</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body style="background: #f7fbff">

    <div class="section">
        <div class="container mt-5">
            <h1 class="text-center my-4" style="color: #1f0f0f; font-weight: bolder">MS.Store</h1>
            <a href="/produks" class="btn btn-md btn-success mb-3">DATA PRODUK</a>
            <div style="background-color: white; padding: 10px auto">
                <div class="box">
                    <div class="row">
                        @forelse ($produks as $produk)
                            <?php
                            $harga = $produk->harga;
                            ?>
                            <div class="card">
                                <a href="{{ route('produks.show', $produk->id) }}">
                                    <div class="image">
                                        <img width="250px" height="200px"
                                            src="{{ asset('storage/produks/' . $produk->image) }}" alt="Gambar produk">
                                    </div>
                                </a>

                                <div class="description text-center">
                                    <p style="font-weight: bold">{{ $produk->nama_produk }}</p>
                                    <div class="harga">
                                        <p><?= 'Rp ' . number_format($harga, 0, ',', '.') ?></p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-danger">
                                Produk Tidak Tersedia.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
