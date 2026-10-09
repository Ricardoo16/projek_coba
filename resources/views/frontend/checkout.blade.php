<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Checkout - Warung Hijab</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light p-4">
    <div class="container" style="max-width: 700px;">
        <h2 class="mb-4">Form Pembelian</h2>

        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Ringkasan Pesanan</h5>
                <p class="mb-1"><strong>Produk:</strong> {{ $product->name }}</p>
                <p class="mb-1"><strong>Harga:</strong> Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            </div>
        </div>

        <form action="{{ route('checkout.store') }}" method="POST" class="card p-4 shadow-sm">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">

            <h5 class="mb-3">Data Pengiriman</h5>

            <div class="mb-3">
                <label>Nama Lengkap</label>
                <input type="text" name="customer_name" class="form-control" 
                       value="{{ auth()->check() ? auth()->user()->name : old('customer_name') }}" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="customer_email" class="form-control" 
                       value="{{ auth()->check() ? auth()->user()->email : old('customer_email') }}" required>
            </div>

            <div class="mb-3">
                <label>Nomor Telepon/WhatsApp</label>
                <input type="text" name="customer_phone" class="form-control" placeholder="081234567890" required>
            </div>

            <div class="mb-3">
                <label>Alamat Pengiriman Lengkap</label>
                <textarea name="shipping_address" class="form-control" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label>Jumlah Beli (Qty)</label>
                <input type="number" name="quantity" class="form-control" value="1" min="1" max="{{ $product->stock }}" required>
            </div>

            <button type="submit" class="btn btn-success w-100 btn-lg">Konfirmasi & Buat Pesanan</button>
        </form>
    </div>
</body>
</html>