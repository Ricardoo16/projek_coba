<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Berhasil - Warung Hijab</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light p-4">
    <div class="container" style="max-width: 650px;">
        <div class="card shadow-sm border-0 text-center p-4">
            <div class="mb-3">
                <span class="badge bg-success p-3 rounded-circle" style="font-size: 2rem;">✓</span>
            </div>
            <h2 class="text-success fw-bold">Pesanan Berhasil Dibuat!</h2>
            <p class="text-muted">Terima kasih telah berbelanja di Warung Hijab. Simpan kode transaksi Anda untuk pengecekan status pesanan.</p>

            <div class="alert alert-secondary my-3">
                <span class="text-muted d-block small">Kode Transaksi:</span>
                <strong class="fs-4 text-dark">{{ $order->code }}</strong>
            </div>

            <div class="card text-start mb-4">
                <div class="card-header bg-white fw-bold">
                    Rincian Pemesanan
                </div>
                <div class="card-body">
                    <p class="mb-2"><strong>Nama Pemesan:</strong> {{ $order->customer_name }}</p>
                    <p class="mb-2"><strong>Email:</strong> {{ $order->customer_email }}</p>
                    <p class="mb-2"><strong>No. Telepon:</strong> {{ $order->customer_phone }}</p>
                    <p class="mb-2"><strong>Alamat Pengiriman:</strong> {{ $order->shipping_address }}</p>
                    <hr>
                    <p class="mb-2"><strong>Status Pembayaran:</strong> 
                        <span class="badge bg-warning text-dark">{{ strtoupper($order->status) }}</span>
                    </p>
                    <p class="mb-0"><strong>Total Pembayaran:</strong> 
                        <span class="text-primary fw-bold fs-5">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </p>
                </div>
            </div>

            <div class="d-grid gap-2">
                <a href="{{ route('home') }}" class="btn btn-primary btn-lg">Kembali ke Katalog Utama</a>
            </div>
        </div>
    </div>
</body>
</html>