<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tentang Kami') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4 tracking-tight">PT. Solusi Bearing Indonesia</h3>
                    
                    <div class="prose max-w-none text-gray-600 space-y-4">
                        <p>
                            Berdiri sejak tahun 2018, PT. Solusi Bearing Indonesia ("Bearing Kita") telah berkembang menjadi pemasok dan distributor komponen industri bearing terdepan. Kami menyediakan berbagai jenis bearing dari brand-brand terpercaya untuk kebutuhan otomotif, manufaktur, dan industri spesifik lainnya.
                        </p>
                        
                        <p>
                            Misi kami adalah memberikan pelanggan produk bearing original berkualitas tinggi dengan harga yang kompetitif, serta didukung oleh layanan pengiriman yang cepat dan konsultasi teknis bagi efisiensi mesin industri Anda.
                        </p>

                        <div class="mt-8 border-t border-gray-200 pt-6">
                            <h4 class="text-xl font-bold text-gray-800 mb-4">Informasi Kontak</h4>
                            <ul class="space-y-2 text-sm">
                                <li class="flex items-start">
                                    <svg class="h-5 w-5 text-red-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    Kawasan Industri Cikarang Kav. 123, Jawa Barat
                                </li>
                                <li class="flex items-start">
                                    <svg class="h-5 w-5 text-red-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    halo@bearingkita.com
                                </li>
                                <li class="flex items-start">
                                    <svg class="h-5 w-5 text-red-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                    +62 812 3456 7890
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>