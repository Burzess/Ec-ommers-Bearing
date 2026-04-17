<x-app-layout>
    <div class="overflow-hidden bg-white py-4 px-4 md:py-8 font-['Poppins']">
        <div class="max-w-[1100px] mx-auto">
            <div class="flex flex-col md:flex-row items-stretch">
                <!-- Sisi Kiri: Tujuan Pengiriman -->
                <div class="w-full md:w-1/2 md:pr-12 pb-8 md:pb-0 md:border-r-[10px] border-black flex flex-col">
                    <div>
                        <h1 class="mb-6 text-2xl md:text-3xl font-black uppercase underline decoration-[4px] underline-offset-8 text-black tracking-tight">
                            TUJUAN PENGIRIMAN
                        </h1>

                        <div class="space-y-6">
                            <!-- Field: Kota/Kabupaten -->
                            <div class="space-y-2">
                                <label class="block text-sm font-extrabold uppercase text-black ml-1">
                                    Pilih Kota Atau Kabupaten Tujuan
                                </label>
                                <div class="relative">
                                    <input type="text" value="SURABAYA" 
                                        class="block w-full rounded-lg border-0 px-4 py-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 outline-none transition-all duration-200 focus:ring-2 focus:ring-inset focus:ring-[#a20202] sm:text-sm sm:leading-6 uppercase font-bold">
                                    <svg class="absolute right-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>

                            <!-- Field: Nomor Telepon -->
                            <div class="space-y-2">
                                <label class="block text-sm font-extrabold uppercase text-black ml-1">
                                    Nomor Telepon
                                </label>
                                <input type="text" value="+62 812 3456 7890" 
                                    class="block w-full rounded-lg border-0 px-4 py-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#a20202] sm:text-sm sm:leading-6 transition-all duration-200 font-bold">
                            </div>

                            <!-- Field: Alamat -->
                            <div class="space-y-2">
                                <label class="block text-sm font-extrabold uppercase text-black ml-1">
                                    Alamat Tujuan
                                </label>
                                <textarea rows="4"
                                    class="block w-full rounded-lg border-0 px-4 py-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 outline-none transition-all duration-200 focus:ring-2 focus:ring-inset focus:ring-[#a20202] sm:text-sm sm:leading-6 font-medium min-h-[100px] resize-none">Jl. Tambak Mayor Barat I, Asemrowo, Surabaya, Jawa Timur</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Cek Ongkir -->
                    <div class="flex items-center justify-between mt-8">
                        <button class="bg-[#a20202] text-white font-black px-6 py-2.5 rounded-full hover:bg-[#8a0202] transition-all text-[12px] uppercase tracking-widest shadow-lg transform hover:scale-105">
                            UBAH TUJUAN
                        </button>
                        <button class="bg-[#a20202] text-white font-black px-8 py-2.5 rounded-full hover:bg-[#8a0202] text-[14px] shadow-xl transition-all transform hover:scale-105 uppercase tracking-widest">
                            CEK ONGKIR
                        </button>
                    </div>
                </div>

                <!-- Sisi Kanan: Alamat Pengiriman & Detail -->
                <div class="w-full md:w-1/2 md:pl-4 pt-12 md:pt-0 flex flex-col">
                    <div class="flex-grow">
                        <h2 class="mb-6 text-2xl md:text-3xl font-black uppercase underline decoration-[4px] underline-offset-8 text-black tracking-tight">
                            ALAMAT PENGIRIMAN
                        </h2>

                        @php
                            $method = request('method', 'bca');
                            $methodNames = [
                                'bca' => 'Transfer Bank BCA',
                                'debit' => 'Debit / Kredit',
                                'cash' => 'Cash Tunai'
                            ];
                            $selectedMethodName = $methodNames[$method] ?? 'Transfer Bank BCA';
                        @endphp

                        <div class="mt-8">
                            <p class="text-[17px] font-bold text-black leading-relaxed">
                                Jl. Tambak Mayor Barat I, Asemrowo, Surabaya, Jawa Timur
                            </p>
                        </div>
                            
                            <!-- Garis Horizontal Tebal -->
                            <div class="w-full h-[10px] bg-black mt-6"></div>

                            @php
                                $cartTotal = $cart->items->sum(fn($item) => $item->product->price * $item->quantity);
                                $shippingCost = 12000;
                                $grandTotal = $cartTotal + $shippingCost;
                            @endphp

                            <!-- Rincian Pembayaran Card -->
                            <div class="mt-4 p-5 border-[2px] border-black rounded-[24px] bg-[#f8fafc] shadow-[0_4px_0_rgba(0,0,0,0.05)]">
                                <h3 class="text-[14px] font-black uppercase tracking-widest text-black mb-4 border-b-2 border-black pb-1.5 inline-block">
                                    RINCIAN PEMBAYARAN
                                </h3>
                                
                                <div class="space-y-3">
                                    <div class="flex justify-between items-center">
                                        <span class="text-[13px] font-bold text-[#4b5563]">Subtotal Produk</span>
                                        <span class="text-[14px] font-bold text-black">
                                            Rp {{ number_format($cartTotal, 0, '.', '.') }}
                                        </span>
                                    </div>
                                    
                                    <div class="flex justify-between items-center">
                                        <span class="text-[13px] font-bold text-[#4b5563]">Biaya Ongkir</span>
                                        <span class="text-[14px] font-bold text-black">
                                            Rp {{ number_format($shippingCost, 0, '.', '.') }}
                                        </span>
                                    </div>

                                    <div class="flex justify-between items-center bg-gray-200 p-3 rounded-lg border border-black/5">
                                        <div class="flex items-center gap-2">
                                            <svg class="w-3.5 h-3.5 text-[#1e40af]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                                            <span class="text-[11px] font-black uppercase text-[#6b7280]">Metode Pembayaran</span>
                                        </div>
                                        <span class="text-[13px] font-black text-[#1e40af]">{{ $selectedMethodName }}</span>
                                    </div>

                                    <div class="pt-3 mt-1 border-t-2 border-black flex justify-between items-end">
                                        <span class="text-[12px] font-black uppercase text-[#6b7280] mb-1.5 tracking-widest">Total Bayar</span>
                                        <div class="flex items-baseline gap-1 animate-pulse-subtle">
                                            <span class="text-[16px] font-black text-[#a20202]">Rp</span>
                                            <span class="text-[28px] font-black text-[#a20202] leading-none tracking-tighter">
                                                {{ number_format($grandTotal, 0, '.', '.') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>

                    <!-- Tombol Simpan -->
                    <div class="flex justify-end mt-8 pb-8">
                        <button class="bg-[#a20202] text-white font-black px-10 py-2.5 rounded-full hover:bg-[#8a0202] text-[15px] shadow-xl transition-all transform hover:scale-105 uppercase tracking-widest">
                            SIMPAN
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
    <style>
        /* Desain Tambahan untuk kehalusan visual */
        body {
            overflow: hidden !important;
        }
        [md\:border-r-\[10px\]] {
            border-right-width: 10px !important;
        }
        .underline {
            text-decoration-thickness: 4px;
        }
    </style>
    @endpush
</x-app-layout>
