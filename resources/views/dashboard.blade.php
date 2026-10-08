<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin - Warung Hijab') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Selamat Datang, {{ Auth::user()->name }}!</h3>
                <p class="mb-6 text-gray-600">Kamu login sebagai <strong>{{ strtoupper(Auth::user()->role) }}</strong>.</p>

                @if(Auth::user()->role === 'admin')
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <a href="{{ route('admin.products.index') }}" class="block p-6 bg-blue-500 text-black rounded-lg shadow hover:bg-blue-600">
                            <h4 class="font-bold text-xl">Kelola Produk</h4>
                            <p class="text-sm">Tambah, edit, dan hapus produk toko.</p>
                        </a>
                    </div>
                @else
                    <p>Selamat berbelanja di Warung Hijab!</p>
                    <a href="/" class="inline-block mt-4 bg-green-500 text-white px-4 py-2 rounded">Lihat Katalog Produk</a>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>