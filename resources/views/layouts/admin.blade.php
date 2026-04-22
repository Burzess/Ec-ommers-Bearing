<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Admin</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="admin-layout font-sans antialiased bg-gray-100 text-gray-900" x-data="{ sidebarOpen: false, profileOpen: false }">
        <div class="min-h-screen lg:flex lg:h-screen lg:overflow-hidden">
            <!-- Mobile Backdrop -->
            <div
                x-show="sidebarOpen"
                x-transition.opacity
                @click="sidebarOpen = false"
                class="fixed inset-0 z-30 bg-black/40 lg:hidden"
                style="display: none;"
            ></div>

            <!-- Sidebar Desktop -->
            <aside class="hidden w-72 shrink-0 border-r border-gray-200 bg-white lg:sticky lg:top-0 lg:flex lg:h-screen lg:flex-col lg:overflow-y-auto">
                <div class="flex h-16 items-center justify-center border-b border-gray-200 px-6">
                    <x-application-logo class="h-14 w-auto" />
                </div>

                <nav class="space-y-1 p-4">
                    <p class="px-3 pb-2 text-xs font-semibold uppercase tracking-wider text-gray-400">Menu Utama</p>

                    <a
                        href="{{ route('admin.dashboard') }}"
                        class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition {{ request()->routeIs('admin.dashboard') ? 'bg-red-50 text-[#A20202]' : 'text-gray-600 hover:bg-gray-100' }}"
                    >
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9.75 12 3l9 6.75V21a.75.75 0 0 1-.75.75h-5.5A.75.75 0 0 1 14 21v-4.5h-4V21a.75.75 0 0 1-.75.75h-5.5A.75.75 0 0 1 3 21V9.75Z" />
                        </svg>
                        Dashboard
                    </a>

                    <a
                        href="{{ route('admin.categories.index') }}"
                        class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition {{ request()->routeIs('admin.categories.*') ? 'bg-red-50 text-[#A20202]' : 'text-gray-600 hover:bg-gray-100' }}"
                    >
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h10M7 12h10M7 17h10M4 7h.01M4 12h.01M4 17h.01" />
                        </svg>
                        Kelola Kategori
                    </a>

                    <a
                        href="{{ route('admin.products.index') }}"
                        class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition {{ request()->routeIs('admin.products.*') ? 'bg-red-50 text-[#A20202]' : 'text-gray-600 hover:bg-gray-100' }}"
                    >
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7 12 3 4 7m16 0v10l-8 4m8-14-8 4m0 10-8-4V7m8 14V11M4 7l8 4" />
                        </svg>
                        Katalog Produk
                    </a>

                    <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition {{ request()->routeIs('admin.orders.*') ? 'bg-red-50 text-[#A20202]' : 'text-gray-600 hover:bg-gray-100' }}">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5h6m-7 4h8m-8 4h8M7 3h10a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2Z" />
                        </svg>
                        Daftar Pesanan
                    </a>

                    <a href="{{ route('admin.customers.index') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition {{ request()->routeIs('admin.customers.*') ? 'bg-red-50 text-[#A20202]' : 'text-gray-600 hover:bg-gray-100' }}">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19a3 3 0 1 0-6 0m6 0H9m6 0h3m-9 0H6m9-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 9a3 3 0 1 0-6 0m6 0h1.5a1.5 1.5 0 0 0 1.5-1.5V16a4 4 0 0 0-4-4h-1m-10 7a3 3 0 1 0-6 0m6 0H3.5A1.5 1.5 0 0 1 2 17.5V16a4 4 0 0 1 4-4h1" />
                        </svg>
                        Data Pelanggan
                    </a>

                    <a href="{{ route('admin.company-setting.edit') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition {{ request()->routeIs('admin.company-setting.*') ? 'bg-red-50 text-[#A20202]' : 'text-gray-600 hover:bg-gray-100' }}">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.5 6h9M10.5 12h9m-9 6h9M4.5 6h.01M4.5 12h.01M4.5 18h.01" />
                        </svg>
                        Profil Perusahaan
                    </a>

                    <a href="{{ route('admin.shipping-cities.index') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition {{ request()->routeIs('admin.shipping-cities.*') ? 'bg-red-50 text-[#A20202]' : 'text-gray-600 hover:bg-gray-100' }}">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21s-6-4.35-6-10a6 6 0 1 1 12 0c0 5.65-6 10-6 10Zm0-7.5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                        </svg>
                        Ongkir Kota
                    </a>

                    <a href="{{ route('admin.payment-methods.index') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition {{ request()->routeIs('admin.payment-methods.*') ? 'bg-red-50 text-[#A20202]' : 'text-gray-600 hover:bg-gray-100' }}">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 0 0 3-3V8a3 3 0 0 0-3-3H6a3 3 0 0 0-3 3v8a3 3 0 0 0 3 3Z" />
                        </svg>
                        Metode Pembayaran
                    </a>
                </nav>
            </aside>

            <!-- Sidebar Mobile -->
            <aside
                x-show="sidebarOpen"
                x-transition:enter="transition-transform duration-200"
                x-transition:enter-start="-translate-x-full"
                x-transition:enter-end="translate-x-0"
                x-transition:leave="transition-transform duration-200"
                x-transition:leave-start="translate-x-0"
                x-transition:leave-end="-translate-x-full"
                class="fixed inset-y-0 left-0 z-40 flex w-72 flex-col border-r border-gray-200 bg-white lg:hidden"
                style="display: none;"
            >
                <div class="flex h-16 items-center justify-between border-b border-gray-200 px-6">
                    <div class="flex items-center gap-3">
                        <x-application-logo class="h-8 w-auto" />
                        <p class="text-lg font-extrabold tracking-wide text-[#A20202]">{{ config('app.name', 'Laravel') }}</p>
                    </div>
                    <button @click="sidebarOpen = false" class="rounded-md p-1 text-gray-500 hover:bg-gray-100">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m6 18 12-12M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <nav class="space-y-1 p-4">
                    <a href="{{ route('admin.dashboard') }}" class="block rounded-xl px-3 py-2.5 text-sm font-semibold {{ request()->routeIs('admin.dashboard') ? 'bg-red-50 text-[#A20202]' : 'text-gray-600 hover:bg-gray-100' }}">Dashboard</a>
                    <a href="{{ route('admin.products.index') }}" class="block rounded-xl px-3 py-2.5 text-sm font-semibold {{ request()->routeIs('admin.products.*') ? 'bg-red-50 text-[#A20202]' : 'text-gray-600 hover:bg-gray-100' }}">Katalog Produk</a>
                    <a href="{{ route('admin.categories.index') }}" class="block rounded-xl px-3 py-2.5 text-sm font-semibold {{ request()->routeIs('admin.categories.*') ? 'bg-red-50 text-[#A20202]' : 'text-gray-600 hover:bg-gray-100' }}">Kelola Kategori</a>
                    <a href="{{ route('admin.orders.index') }}" class="block rounded-xl px-3 py-2.5 text-sm font-semibold {{ request()->routeIs('admin.orders.*') ? 'bg-red-50 text-[#A20202]' : 'text-gray-600 hover:bg-gray-100' }}">Daftar Pesanan</a>
                    <a href="{{ route('admin.customers.index') }}" class="block rounded-xl px-3 py-2.5 text-sm font-semibold {{ request()->routeIs('admin.customers.*') ? 'bg-red-50 text-[#A20202]' : 'text-gray-600 hover:bg-gray-100' }}">Data Pelanggan</a>
                    <a href="{{ route('admin.company-setting.edit') }}" class="block rounded-xl px-3 py-2.5 text-sm font-semibold {{ request()->routeIs('admin.company-setting.*') ? 'bg-red-50 text-[#A20202]' : 'text-gray-600 hover:bg-gray-100' }}">Profil Perusahaan</a>
                    <a href="{{ route('admin.shipping-cities.index') }}" class="block rounded-xl px-3 py-2.5 text-sm font-semibold {{ request()->routeIs('admin.shipping-cities.*') ? 'bg-red-50 text-[#A20202]' : 'text-gray-600 hover:bg-gray-100' }}">Ongkir Kota</a>
                    <a href="{{ route('admin.payment-methods.index') }}" class="block rounded-xl px-3 py-2.5 text-sm font-semibold {{ request()->routeIs('admin.payment-methods.*') ? 'bg-red-50 text-[#A20202]' : 'text-gray-600 hover:bg-gray-100' }}">Metode Pembayaran</a>
                </nav>
            </aside>

            <!-- Content -->
            <div class="flex min-w-0 flex-1 flex-col lg:h-screen">
                <header class="sticky top-0 z-20 flex h-16 items-center justify-between border-b border-gray-200 bg-white px-4 sm:px-6">
                    <div class="flex items-center gap-3">
                        <button @click="sidebarOpen = true" class="rounded-md p-1 text-gray-500 hover:bg-gray-100 lg:hidden">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                        <h1 class="text-base font-semibold text-gray-700 sm:text-lg">Panel Admin</h1>
                    </div>

                    <div class="relative" @click.away="profileOpen = false">
                        <button @click="profileOpen = !profileOpen" class="flex items-center gap-2 rounded-full px-2 py-1 text-sm font-semibold text-gray-700 hover:bg-gray-100">
                            <span>{{ Auth::user()->name ?? 'Admin User' }}</span>
                            <span class="flex h-7 w-7 items-center justify-center rounded-full bg-gray-100 text-gray-500">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 1 1-8 0 4 4 0 0 1 8 0Zm-8 10a4 4 0 0 1 8 0" />
                                </svg>
                            </span>
                        </button>

                        <div x-show="profileOpen" x-transition class="absolute right-0 mt-2 w-44 rounded-xl border border-gray-200 bg-white py-1 shadow-lg" style="display: none;">
                            <a href="{{ route('admin.profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Profil</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full px-4 py-2 text-left text-sm text-red-600 hover:bg-red-50">Log Out</button>
                            </form>
                        </div>
                    </div>
                </header>

                <main class="flex-1 overflow-y-auto p-4 sm:p-6">
                    @isset($header)
                        <h2 class="mb-5 text-2xl font-bold text-gray-900">{{ $header }}</h2>
                    @endisset

                    <div class="mx-auto w-full max-w-7xl">
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>

        @include('components.Toast-notification')
    </body>
</html>