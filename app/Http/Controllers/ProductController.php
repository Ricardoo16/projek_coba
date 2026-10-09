<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get(); // Ambil data dari DB
        return view('frontend.index', compact('products')); // Kirim ke tampilan Blade
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('show', compact('product'));
    }
}