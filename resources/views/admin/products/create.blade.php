<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Produk - Warung Hijab</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-4 bg-light">
    <div class="container" style="max-width: 600px;">
        <div class="card p-4 shadow-sm">
            <h2 class="mb-4">Tambah Produk Baru</h2>
            
            <!-- PENTING: Tambahkan enctype="multipart/form-data" -->
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama Produk</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="category_id" class="form-control" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Input Unggah Gambar Produk -->
                <div class="mb-3">
                    <label class="form-label">Foto Produk</label>
                    <input type="file" name="image" class="form-control" accept="image/*" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Harga (Rp)</label>
                    <input type="number" name="price" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Stok</label>
                    <input type="number" name="stock" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi Produk</label>
                    <textarea name="description" class="form-control" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-success w-100">Simpan Produk</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary w-100 mt-2">Batal</a>
            </form>
        </div>
    </div>
</body>
</html>