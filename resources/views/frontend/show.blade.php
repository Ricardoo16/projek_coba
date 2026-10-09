<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - Warung Hijab</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">Warung Hijab</a>
            <div>
                <a href="{{ route('home') }}" class="btn btn-outline-light btn-sm">Kembali ke Katalog</a>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="card shadow-sm border-0 p-4">
            <div class="row g-4">
                <!-- Foto Produk -->
                <div class="col-md-5">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded border w-100" style="max-height: 400px; object-fit: cover;" alt="{{ $product->name }}">
                    @else
                        <img src="https://via.placeholder.com/400x400?text=No+Image" class="img-fluid rounded border w-100" alt="{{ $product->name }}">
                    @endif
                </div>

                <!-- Informasi Produk -->
                <div class="col-md-7 d-flex flex-column justify-content-between">
                    <div>
                        <span class="badge bg-secondary mb-2">{{ $product->category->name ?? 'Uncategorized' }}</span>
                        <h2 class="fw-bold mb-3">{{ $product->name }}</h2>
                        <h3 class="text-primary fw-bold mb-3">Rp {{ number_format($product->price, 0, ',', '.') }}</h3>
                        
                       <!-- Status Stok -->
                        <div class="mb-3">
                            <strong>Status Stok:</strong>
                            @if($product->stock > 0)
                                <span class="badge bg-success">Tersedia ({{ $product->stock }} pcs)</span>
                            @else
                                <span class="badge bg-danger">Sold Out</span>
                            @endif
                        </div>

                        <hr>

                        <!-- Tombol Beli / Checkout -->
                        <div class="mt-4">
                            @if($product->stock > 0)
                                <a href="{{ route('checkout.create', $product->id) }}" class="btn btn-primary btn-lg w-100 fw-bold">
                                    Beli Sekarang
                                </a>
                            @else
                                <button class="btn btn-danger btn-lg w-100 fw-bold" disabled>
                                    Sold Out
                                </button>
                            @endif
                        </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>