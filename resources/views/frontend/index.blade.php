<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warung Hijab - Katalog Utama</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <!-- Brand / Logo -->
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">Warung Hijab</a>

            <div>
                @auth
                    <!-- Dropdown User -->
                    <div class="dropdown d-inline">
                        <button class="btn btn-outline-light btn-sm dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            👤 {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown">
                            <!-- Edit Profil -->
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    ✏️ Edit Profil
                                </a>
                            </li>

                            <!-- Dashboard Admin (Khusus Role Admin) -->
                            @if(Auth::user()->role === 'admin')
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.products.index') }}">
                                        🛠️ Dashboard Admin
                                    </a>
                                </li>
                            @endif

                            <li><hr class="dropdown-divider"></li>

                            <!-- Logout -->
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        🚪 Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endauth

                @guest
                    <!-- Jika User BELUM Login: Tampilkan Tombol Login & Daftar -->
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm me-1">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Daftar</a>
                @endguest
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <h1 class="mb-4">Katalog Produk Terbaru</h1>
        
        <div class="row">
            @forelse($products as $product)
                <div class="col-md-3 mb-4">
                    <div class="card h-100 shadow-sm border-0">
                        <!-- Gambar Produk dengan Badge Sold Out jika stok 0 -->
                        <div class="position-relative">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                            @else
                                <img src="https://via.placeholder.com/300x200?text=No+Image" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                            @endif

                            @if($product->stock <= 0)
                                <span class="position-absolute top-0 end-0 bg-danger text-white px-3 py-1 m-2 rounded-pill fw-bold fs-7">
                                    Sold Out
                                </span>
                            @endif
                        </div>

                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <span class="badge bg-secondary mb-2">{{ $product->category->name ?? 'Kategori' }}</span>
                                <h5 class="card-title fw-bold">{{ $product->name }}</h5>
                                <p class="card-text text-primary fw-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            </div>

                            <div class="mt-3">
                                @if($product->stock > 0)
                                    <a href="{{ route('product.detail', $product->slug) }}" class="btn btn-outline-primary w-100">Lihat Detail</a>
                                @else
                                    <button class="btn btn-secondary w-100" disabled>Sold Out</button>
                                @endif
                            </div>
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