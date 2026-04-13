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
            Produk Kami
        </h1>

        @forelse($products as $product)
            <article class="mb-10 grid grid-cols-1 items-center gap-6 md:grid-cols-[350px,1fr] md:gap-8">
                <a href="{{ route('products.show', $product) }}" class="flex h-[200px] w-full items-center justify-center overflow-hidden rounded-[20px] border-2 border-black bg-white p-4 md:w-[350px] md:h-[200px]">
                    @if($product->image)
                        <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="h-full w-full object-contain">
                    @else
                        <svg class="size-16 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.4" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 0 0-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 0 0-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 0 0-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 0 0-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 0 0 1.066-2.573c-.94-1.543.826-3.31 2.37-2.37a1.724 1.724 0 0 0 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.4" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                        </svg>
                    @endif
                </a>

                <div class="flex min-h-[200px] flex-col justify-between py-2">
                    <a href="{{ route('products.show', $product) }}" class="text-xl font-bold leading-tight text-black transition-opacity hover:opacity-70 md:text-2xl">
                        {{ $product->name }}
                    </a>
                    <div class="mt-4 flex items-center justify-end gap-3 md:mt-0 md:gap-4">
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
            </article>
        @empty
            <div class="rounded-2xl border-2 border-dashed border-gray-500 px-6 py-10 text-center text-2xl font-semibold text-gray-700">
                Produk tidak ditemukan.
            </div>
        @endforelse
    </section>
</x-app-layout>
