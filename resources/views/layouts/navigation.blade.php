<nav x-data="{ open: false }" class="sticky top-0 z-50 border-b-2 border-black bg-[#500000]">
    <div class="mx-auto flex h-16 max-w-[1440px] items-center justify-between px-4 md:px-8">
        <a href="{{ route('dashboard') }}" class="shrink-0">
            <x-application-logo class="h-32 w-auto object-contain" />
        </a>

        <div class="hidden items-center gap-12 md:flex">
            <a href="{{ route('about') }}" class="text-lg font-bold uppercase text-white transition-opacity hover:opacity-80">Contact</a>
            <a href="{{ route('dashboard') }}" class="text-lg font-bold uppercase text-white transition-opacity hover:opacity-80">Produk</a>
        </div>

        <div class="hidden items-center gap-4 md:flex">
            <a href="{{ auth()->check() ? route('cart.index') : route('login') }}" class="relative text-white transition-opacity hover:opacity-80" aria-label="Keranjang">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="size-7">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                </svg>
                @if(auth()->check() && auth()->user()->cart && auth()->user()->cart->items->sum('quantity') > 0)
                    <span class="absolute -right-2 -top-2 rounded-full bg-white px-1.5 py-0.5 text-[10px] font-bold text-[#500000]">
                        {{ auth()->user()->cart->items->sum('quantity') }}
                    </span>
                @endif
            </a>

            @auth
                <a href="{{ route('profile.edit') }}" class="text-white transition-opacity hover:opacity-80" aria-label="Profil">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="size-7 fill-current">
                        <path d="M12 12a5 5 0 1 0 0-10 5 5 0 0 0 0 10Zm0 2c-5.33 0-8 2.67-8 5v1h16v-1c0-2.33-2.67-5-8-5Z" />
                    </svg>
                </a>
            @else
                <a href="{{ route('login') }}" class="text-white transition-opacity hover:opacity-80" aria-label="Masuk">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="size-7 fill-current">
                        <path d="M12 12a5 5 0 1 0 0-10 5 5 0 0 0 0 10Zm0 2c-5.33 0-8 2.67-8 5v1h16v-1c0-2.33-2.67-5-8-5Z" />
                    </svg>
                </a>
            @endauth
        </div>

        <button @click="open = !open" class="text-white md:hidden" aria-label="Toggle Menu">
            <svg class="size-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <div :class="{'block': open, 'hidden': !open}" class="hidden border-t border-[#7f2a2a] bg-[#500000] px-4 py-3 md:hidden">
        <div class="space-y-2">
            <a href="{{ route('dashboard') }}" class="block text-lg font-semibold text-white">Produk</a>
            <a href="{{ route('about') }}" class="block text-lg font-semibold text-white">Contact</a>
            <a href="{{ auth()->check() ? route('cart.index') : route('login') }}" class="block text-lg font-semibold text-white">Keranjang</a>
            @auth
                <a href="{{ route('profile.edit') }}" class="block text-lg font-semibold text-white">Profil</a>
            @else
                <a href="{{ route('login') }}" class="block text-lg font-semibold text-white">Masuk</a>
                <a href="{{ route('register') }}" class="block text-lg font-semibold text-white">Daftar</a>
            @endauth
        </div>
    </div>
</nav>




