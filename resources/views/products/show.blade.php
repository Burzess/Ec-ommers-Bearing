<x-app-layout>
    <style>
        /* Sembunyikan panah spinner di Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Sembunyikan panah spinner di Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Rincian Produk
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <a href="{{ route('dashboard') }}" class="text-sm text-red-600 hover:text-red-800 font-semibold inline-flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Kembali ke Katalog
                </a>
            </div>
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        
                        <!-- Image Gallery -->
                        <div class="flex flex-col">
                            <div class="bg-gray-100 rounded-xl overflow-hidden flex items-center justify-center h-80 p-4">
                                @if($product->image)
                                    <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="object-contain h-full w-full">
                                @else
                                    <svg class="h-32 w-32 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                @endif
                            </div>
                        </div>

                        <!-- Product Details -->
                        <div class="flex flex-col justify-center">
                            <div class="text-sm font-semibold text-red-600 tracking-wide uppercase mb-1">
                                {{ $product->category->name ?? 'Kategori Umum' }}
                            </div>
                            <h1 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                                {{ $product->name }}
                            </h1>
                            <p class="text-sm text-gray-500 mt-2 font-mono bg-gray-100 px-2 py-1 inline-block rounded max-w-max">SKU: {{ $product->sku }}</p>

                            <div class="mt-4">
                                <h2 class="sr-only">Informasi Harga</h2>
                                <p class="text-3xl text-gray-900 font-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            </div>

                            <div class="mt-6">
                                <h3 class="text-lg font-medium text-gray-900">Spesifikasi Ukuran:</h3>
                                <div class="mt-2 text-base text-gray-700 shadow-sm border border-gray-200 rounded-lg divide-y divide-gray-200">
                                    <div class="flex justify-between py-3 px-4">
                                        <span class="font-medium">Diameter Dalam (Inner)</span>
                                        <span>{{ $product->inner_diameter ?? '-' }} mm</span>
                                    </div>
                                    <div class="flex justify-between py-3 px-4 bg-gray-50">
                                        <span class="font-medium">Diameter Luar (Outer)</span>
                                        <span>{{ $product->outer_diameter ?? '-' }} mm</span>
                                    </div>
                                    <div class="flex justify-between py-3 px-4">
                                        <span class="font-medium">Ketebalan (Thickness)</span>
                                        <span>{{ $product->thickness ?? '-' }} mm</span>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6">
                                <h3 class="text-lg font-medium text-gray-900">Deskripsi:</h3>
                                <div class="mt-2 text-base text-gray-700">
                                    <p>{{ $product->description }}</p>
                                </div>
                            </div>
                            
                            <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-8 flex flex-col gap-4">@csrf<div class="flex flex-col sm:flex-row gap-4 flex-wrap">
                                <div class="flex items-center border border-gray-300 rounded-md">
                                    <button type="button" class="px-4 py-3 text-lg font-bold text-gray-600 hover:text-red-600 hover:bg-gray-100 transition-colors" onclick="const q = document.getElementById('qty'); q.value = Math.max(1, parseInt(q.value) - 1)">-</button>
                                    <input type="number" id="qty" name="quantity" class="w-16 text-center border-none focus:ring-0 p-2 text-gray-900 font-semibold" value="1" min="1" max="{{ $product->stock }}">
                                    <button type="button" class="px-4 py-3 text-lg font-bold text-gray-600 hover:text-red-600 hover:bg-gray-100 transition-colors" onclick="const q = document.getElementById('qty'); q.value = Math.min({{ $product->stock }}, parseInt(q.value) + 1)">+</button>
                                </div>
                                
                                <div class="flex items-center gap-3 flex-1">
                                    <button type="submit" class="p-3 bg-[#a20202] rounded-xl hover:bg-[#8a0202] transition-all shadow-lg transform hover:scale-105" title="Tambah ke Keranjang">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6 text-white">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                        </svg>
                                    </button>
                                    
                                    <button type="submit" name="checkout" value="1" class="flex-1 bg-[#a20202] text-white font-black px-8 py-3.5 rounded-full hover:bg-[#8a0202] focus:outline-none focus:ring-4 focus:ring-red-300 transition-all shadow-xl uppercase tracking-widest text-[14px] transform hover:scale-105 sm:text-[15px] disabled:opacity-50 disabled:cursor-not-allowed" @if($product->stock <= 0) disabled @endif>
                                        BELI SEKARANG
                                    </button>
                                </div>
                                
                                <div class="w-full mt-2 text-sm text-gray-500">
                                    Sisa Stok: <span class="font-bold {{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }}">{{ $product->stock > 0 ? $product->stock . ' Unit' : 'Habis' }}</span></div></form></div></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


