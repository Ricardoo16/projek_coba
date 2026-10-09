<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warung Hijab - Katalog Utama</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Warung Hijab</a>
            <div>
                <a href="/login" class="btn btn-outline-light btn-sm">Login</a>
                <a href="/register" class="btn btn-primary btn-sm">Daftar</a>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <h1 class="mb-4">Katalog Produk Terbaru</h1>
        
        <div class="row">
            @forelse($products as $product)
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <img src="https://via.placeholder.com/300x300" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="text-primary fw-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            <p class="text-primary fw-bold">Stok: {{ $product->stock }}</p>
                            <a href="/product/{{ $product->slug }}" class="btn btn-sm btn-outline-primary w-100">Lihat Detail</a>
                            <a href="{{ route('checkout.create', $product->id) }}" class="btn btn-primary">Beli Sekarang</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="alert alert-info text-center">Belum ada produk yang tersedia saat ini.</p>
                </div>
            @endforelse
        </div>
    </div>
</body>
</html>