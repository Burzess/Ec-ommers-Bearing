<x-app-layout>
    <section class="mx-auto max-w-[1300px] px-4 pb-16 pt-6 md:px-8 md:pt-8">
        <form action="{{ route('dashboard') }}" method="GET" class="mb-7">
            <label for="q" class="sr-only">Cari Produk</label>
            <input
                id="q"
                name="q"
                type="text"
                value="{{ $search ?? '' }}"
                placeholder="Cari Merk / Nama / Tipe Produk"
                class="h-[48px] w-full rounded-[8px] border-2 border-black bg-[#e9e9e9] px-5 text-sm font-semibold text-[#666666] outline-none transition focus:border-[#500000] focus:ring-0 md:text-base"
            >
        </form>

        <h1 class="mb-10 text-2xl font-bold uppercase underline decoration-2 underline-offset-4 md:mb-14 md:text-3xl">
         Katalog Produk
        </h1>

        @forelse($products as $product)
            <article class="relative mb-6 overflow-hidden rounded-2xl border-2 border-gray-300 bg-white p-5 transition-shadow hover:shadow-lg md:p-6">
                <form action="{{ route('cart.add', $product) }}" method="POST" class="dashboard-cart-form absolute right-4 top-4 z-10" onclick="event.stopPropagation()">
                    @csrf
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="flex h-10 w-10 items-center justify-center rounded-full bg-[#500000] text-white shadow-md transition-transform hover:scale-110 active:scale-95" title="Tambah ke Keranjang">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </button>
                </form>
                <div class="grid grid-cols-1 items-center gap-6 md:grid-cols-[280px,1fr] md:gap-8">
                    <a href="{{ route('products.show', $product) }}" class="flex h-[180px] w-full items-center justify-center overflow-hidden rounded-xl border-2 border-black bg-white p-4 md:h-[200px]">
                        @if($product->image)
                            <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="h-full w-full object-contain">
                        @else
                            <svg class="size-16 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.4" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 0 0-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 0 0-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 0 0-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 0 0-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 0 0 1.066-2.573c-.94-1.543.826-3.31 2.37-2.37a1.724 1.724 0 0 0 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.4" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                            </svg>
                        @endif
                    </a>

                    <div class="flex flex-col justify-between py-2">
                        <div>
                            <a href="{{ route('products.show', $product) }}" class="text-xl font-bold leading-tight text-black transition-opacity hover:opacity-70 md:text-2xl">
                                {{ $product->name }}
                            </a>
                            <p class="mt-1 text-sm font-medium text-gray-500">SKU: {{ $product->sku }}</p>

                            @if($product->description)
                                <p class="mt-3 text-sm leading-relaxed text-gray-600">
                                    {{ Str::limit($product->description, 80) }}
                                    <a href="{{ route('products.show', $product) }}" class="font-semibold text-gray-400 hover:underline">lihat detail</a>
                                </p>
                            @endif

                            @if($product->inner_diameter || $product->outer_diameter || $product->thickness)
                                <div class="mt-3 flex flex-wrap gap-2">
                                    @if($product->inner_diameter)
                                        <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-700">
                                            ID: {{ $product->inner_diameter }} mm
                                        </span>
                                    @endif
                                    @if($product->outer_diameter)
                                        <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-700">
                                            OD: {{ $product->outer_diameter }} mm
                                        </span>
                                    @endif
                                    @if($product->thickness)
                                        <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-700">
                                            T: {{ $product->thickness }} mm
                                        </span>
                                    @endif
                                </div>
                            @endif
                        </div>

                        <div class="mt-4 flex items-center justify-between gap-3">
                            <span class="text-sm font-semibold {{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                                {{ $product->stock > 0 ? 'Stok: ' . $product->stock : 'Stok Habis' }}
                            </span>
                            <div class="flex items-center gap-3 md:gap-4">
                                <svg class="h-8 w-10 shrink-0" viewBox="0 0 56 40" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <g transform="rotate(-12 28 20)">
                                        <rect x="4" y="11" width="32" height="18" rx="3" fill="#C30000" />
                                        <circle cx="40" cy="20" r="5" fill="#111827" />
                                    </g>
                                </svg>
                                <span class="text-2xl font-bold leading-none text-black md:text-3xl">
                                    {{ number_format($product->price, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        @empty
            <div class="rounded-2xl border-2 border-dashed border-gray-500 px-6 py-10 text-center text-2xl font-semibold text-gray-700">
                Produk tidak ditemukan.
            </div>
        @endforelse
    </section>

    <script>
        document.querySelectorAll('.dashboard-cart-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const formData = new FormData(this);
                const action = this.getAttribute('action');

                fetch(action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(response => {
                    if (response.redirected || response.status === 401) {
                        window.location.href = '/login';
                        return;
                    }
                    if (response.ok) {
                        showToast('Produk berhasil ditambahkan ke keranjang!');
                    } else {
                        showToast('Gagal menambahkan produk. Pastikan Anda sudah login.', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('Terjadi kesalahan saat menambahkan produk.', 'error');
                });
            });
        });
    </script>
</x-app-layout>
