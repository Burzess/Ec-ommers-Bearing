<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-['Poppins'] bg-white">
        <div class="min-h-screen bg-white">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow-sm">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            <!-- Toast Container -->
            <div id="toast-container" class="fixed bottom-5 right-5 z-50 flex flex-col gap-2"></div>

            <script>
                function showToast(message, type = 'success') {
                    const container = document.getElementById('toast-container');
                    const id = 'toast-' + Math.random().toString(36).substr(2, 9);
                    
                    const toastHtml = `
                        <div id="${id}" class="flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow border-l-4 ${type === 'success' ? 'border-green-500' : 'border-red-500'} animate-fade-in-right" role="alert">
                            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 ${type === 'success' ? 'text-green-500 bg-green-100' : 'text-red-500 bg-red-100'} rounded-lg">
                                ${type === 'success' ? 
                                    '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>' : 
                                    '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>'
                                }
                            </div>
                            <div class="ml-3 text-sm font-normal">${message}</div>
                            <button type="button" onclick="document.getElementById('${id}').remove()" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8">
                                <span class="sr-only">Close</span>
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            </button>
                        </div>
                    `;
                    
                    const div = document.createElement('div');
                    div.innerHTML = toastHtml.trim();
                    const toastElement = div.firstChild;
                    container.appendChild(toastElement);

                    // Auto remove
                    setTimeout(() => {
                        if (toastElement && toastElement.parentNode) {
                            toastElement.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                            toastElement.style.opacity = '0';
                            toastElement.style.transform = 'translateX(100%)';
                            setTimeout(() => toastElement.remove(), 500);
                        }
                    }, 3500);
                }

                @if(session('success'))
                    window.addEventListener('DOMContentLoaded', () => {
                        showToast("{{ session('success') }}", 'success');
                    });
                @endif
                
                @if(session('error'))
                    window.addEventListener('DOMContentLoaded', () => {
                        showToast("{{ session('error') }}", 'error');
                    });
                @endif
            </script>

            <style>
                @keyframes fade-in-right {
                    from { opacity: 0; transform: translateX(100%); }
                    to { opacity: 1; transform: translateX(0); }
                }
                .animate-fade-in-right {
                    animation: fade-in-right 0.3s ease-out;
                }
            </style>
        </div>
    </body>
</html>
