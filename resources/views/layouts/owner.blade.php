<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Owner</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-100 text-gray-900" x-data="{ sidebarOpen: false }">
        <div class="min-h-screen lg:flex lg:h-screen lg:overflow-hidden">
            <div
                x-show="sidebarOpen"
                x-transition.opacity
                @click="sidebarOpen = false"
                class="fixed inset-0 z-30 bg-black/40 lg:hidden"
                style="display: none;"
            ></div>

            <aside class="hidden w-72 shrink-0 border-r border-gray-200 bg-white lg:sticky lg:top-0 lg:flex lg:h-screen lg:flex-col lg:overflow-y-auto">
                <div class="flex h-16 items-center justify-center border-b border-gray-200 px-6">
                    <x-application-logo class="h-14 w-auto" />
                </div>

                <nav class="space-y-1 p-4">
                    <p class="px-3 pb-2 text-xs font-semibold uppercase tracking-wider text-gray-400">Menu Owner</p>

                    <a
                        href="{{ route('owner.dashboard') }}"
                        class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition {{ request()->routeIs('owner.dashboard') ? 'bg-red-50 text-[#A20202]' : 'text-gray-600 hover:bg-gray-100' }}"
                    >
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9.75 12 3l9 6.75V21a.75.75 0 0 1-.75.75h-5.5A.75.75 0 0 1 14 21v-4.5h-4V21a.75.75 0 0 1-.75.75h-5.5A.75.75 0 0 1 3 21V9.75Z" />
                        </svg>
                        Dashboard Pendapatan
                    </a>
                </nav>
            </aside>

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
                    <a href="{{ route('owner.dashboard') }}" class="block rounded-xl px-3 py-2.5 text-sm font-semibold {{ request()->routeIs('owner.dashboard') ? 'bg-red-50 text-[#A20202]' : 'text-gray-600 hover:bg-gray-100' }}">
                        Dashboard Pendapatan
                    </a>
                </nav>
            </aside>

            <div class="flex min-w-0 flex-1 flex-col lg:h-screen">
                <header class="sticky top-0 z-20 flex h-16 items-center justify-between border-b border-gray-200 bg-white px-4 sm:px-6">
                    <div class="flex items-center gap-3">
                        <button @click="sidebarOpen = true" class="rounded-md p-1 text-gray-500 hover:bg-gray-100 lg:hidden">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                        <h1 class="text-base font-semibold text-gray-700 sm:text-lg">Panel Owner</h1>
                    </div>

                    <div class="flex items-center gap-3">
                        <p class="hidden text-sm font-semibold text-gray-600 sm:block">{{ Auth::user()->name }}</p>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="rounded-lg bg-red-50 px-3 py-2 text-xs font-bold text-[#A20202] hover:bg-red-100">
                                Log Out
                            </button>
                        </form>
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
    </body>
</html>
