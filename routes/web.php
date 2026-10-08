<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;

// ==========================================
// 1. RUTE TOKO ONLINE (PUBLIK / PEMBELI)
// ==========================================

// Halaman utama katalog produk
Route::get('/', [ProductController::class, 'index'])->name('home');

// Detail produk berdasarkan slug
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.detail');

// Form Beli / Checkout (Bisa diakses Guest & User)
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');


// ==========================================
// 2. RUTE USER BIASA (Breeze Dashboard & Profile)
// ==========================================

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// ==========================================
// 3. RUTE KHUSUS ADMIN (warunghijab/admin)
// ==========================================

Route::prefix('admin')->middleware(['auth', IsAdmin::class])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('products', AdminProductController::class)->names('admin.products');
});


// ==========================================
// 4. RUTE AUTENTIKASI (BREEZE)
// ==========================================

require __DIR__.'/auth.php';