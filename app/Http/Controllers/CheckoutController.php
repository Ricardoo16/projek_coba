<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    // Tampilkan Form Checkout
    public function create($productId)
    {
        $product = Product::findOrFail($productId);
            // Cek jika stok habis
            if ($product->stock <= 0) {
                return redirect()->route('home')->with('error', 'Maaf, produk ini telah Sold Out!');
            }
            return view('frontend.checkout', compact('product'));
    }

    // Proses Simpan Transaksi
    public function store(Request $request)
    {
        $request->validate([
            'product_id'       => 'required|exists:products,id',
            'customer_name'    => 'required|string|max:255',
            'customer_email'   => 'required|email',
            'customer_phone'   => 'required|string',
            'shipping_address' => 'required|string',
            'quantity'         => 'required|integer|min:1',
        ]);

        $orderCode = 'TRX-' . strtoupper(Str::random(8));

        // Jalankan database transaction & simpan nilai kembalian ke variabel
        $order = DB::transaction(function () use ($request, $orderCode) {
            // 1. Kunci baris produk (lockForUpdate) untuk menghindari race condition stok
            $product = Product::where('id', $request->product_id)->lockForUpdate()->firstOrFail();

            // 2. Cek ketersediaan stok di dalam transaksi
            if ($product->stock < $request->quantity) {
                throw new \Exception('Stok barang tidak mencukupi!');
            }

            $totalPrice = $product->price * $request->quantity;

            // 3. Simpan ke tabel orders
            $order = Order::create([
                'user_id'          => auth()->check() ? auth()->id() : null,
                'code'             => $orderCode,
                'customer_name'    => $request->customer_name,
                'customer_email'   => $request->customer_email,
                'customer_phone'   => $request->customer_phone,
                'shipping_address' => $request->shipping_address,
                'total_price'      => $totalPrice,
                'status'           => 'pending',
            ]);

            // 4. Simpan rincian ke order_items
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $product->id,
                'quantity'   => $request->quantity,
                'price'      => $product->price,
            ]);

            // 5. Potong stok produk
            $product->decrement('stock', $request->quantity);

            return $order;
        });

        return redirect()->route('checkout.success', $order->code)
                        ->with('success', 'Pesanan berhasil dibuat!');
    }

    // Halaman Berhasil Transaksi
    public function success($code)
    {
        $order = Order::where('code', $code)->firstOrFail();
        return view('frontend.success', compact('order'));
    }
}