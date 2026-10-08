<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
        public function index()
    {
        return "Halaman Katalog Utama Warung Hijab";
    }

    public function show($slug)
    {
        return "Detail Produk: " . $slug;
    }
}
