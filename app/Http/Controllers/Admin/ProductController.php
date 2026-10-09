<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // 1. Tampilkan Semua Produk
    public function index()
    {
        $products = Product::with('category')->latest()->get();
        return view('admin.products.index', compact('products'));
    }

    // 2. Form Tambah Produk
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    // 3. Simpan Produk Baru
    public function store(Request $request)
    {
            // Validasi input termasuk gambar
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Maksimal 2MB
            'description' => 'nullable|string',
        ]);

        // Simpan gambar ke folder storage/app/public/products
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        // Simpan data produk ke database
        Product::create([
            'name' => $request->name,
            'slug' => \Illuminate\Support\Str::slug($request->name),
            'category_id' => $request->category_id,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $imagePath, // Menyimpan path gambar (contoh: products/abc.jpg)
            'description' => $request->description,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Produk dan gambar berhasil ditambahkan!');
    }

    // 4. Form Edit Produk
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    // 5. Update Produk
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ]);

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'category_id' => $request->category_id,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
        ];

        // Jika admin mengunggah foto baru
        if ($request->hasFile('image')) {
            // Hapus foto lama di storage jika ada
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            // Simpan foto baru
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui!');
    }

    // 6. Hapus Produk
    public function destroy(Product $product)
    {
        // Hapus foto terkait di storage jika ada
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus!');
    }
}