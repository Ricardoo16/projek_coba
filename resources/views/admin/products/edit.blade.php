<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Produk - Warung Hijab</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-4 bg-light">
    <div class="container" style="max-width: 600px;">
        <div class="card p-4 shadow-sm">
            <h2 class="mb-4">Edit Produk</h2>
            
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nama Produk</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="category_id" class="form-control" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Foto Produk Baru (Opsional)</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    @if($product->image)
                        <div class="mt-2">
                            <small class="text-muted d-block mb-1">Foto Saat Ini:</small>
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="max-height: 100px;" class="rounded border">
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label class="form-label">Harga (Rp)</label>
                    <input type="number" name="price" class="form-control" value="{{ old('price', $product->price) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Stok</label>
                    <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi Produk</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description', $product->description) }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary w-100">Perbarui Produk</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary w-100 mt-2">Batal</a>
            </form>
        </div>
    </div>
</body>
</html>