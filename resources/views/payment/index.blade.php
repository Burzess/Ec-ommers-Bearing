<x-app-layout>
    <div class="overflow-hidden bg-white px-4 py-4 font-['Poppins'] md:py-8">
        <div class="mx-auto max-w-[1100px]">
            <div class="flex flex-col items-stretch md:flex-row">
                <div class="flex w-full flex-col border-black pb-8 md:w-1/2 md:border-r-[10px] md:pb-0 md:pr-12">
                    <form method="GET" action="{{ route('payment.index') }}" class="flex h-full flex-col">
                        <div>
                            <h1 class="mb-6 text-2xl font-black uppercase tracking-tight text-black underline decoration-[4px] underline-offset-8 md:text-3xl">
                                TUJUAN PENGIRIMAN
                            </h1>

                            <div class="space-y-6">
                                <div class="space-y-2">
                                    <label for="shipping_city_id" class="ml-1 block text-sm font-extrabold uppercase text-black">
                                        Pilih Kota Atau Kabupaten Tujuan
                                    </label>
                                    <div class="relative">
                                        <select id="shipping_city_id" name="shipping_city_id"
                                            class="block w-full rounded-lg border-0 px-4 py-3 text-sm font-bold uppercase text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 transition-all duration-200 focus:ring-2 focus:ring-inset focus:ring-[#a20202] sm:leading-6"
                                            required>
                                            @foreach ($shippingCities as $shippingCity)
                                                <option value="{{ $shippingCity->id }}"
                                                    @selected($selectedShippingCity?->id === $shippingCity->id)>
                                                    {{ $shippingCity->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <svg class="pointer-events-none absolute right-4 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </div>
                                </div>

                                <div class="space-y-2">
                                    <label class="ml-1 block text-sm font-extrabold uppercase text-black">
                                        Nomor Telepon
                                    </label>
                                    <input type="text" value="{{ $user->phone ?? '-' }}" readonly
                                        class="block w-full rounded-lg border-0 px-4 py-3 text-sm font-bold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 transition-all duration-200 focus:ring-2 focus:ring-inset focus:ring-[#a20202] sm:leading-6">
                                </div>

                                <div class="space-y-2">
                                    <label class="ml-1 block text-sm font-extrabold uppercase text-black">
                                        Alamat Tujuan
                                    </label>
                                    <textarea rows="4" readonly
                                        class="block min-h-[100px] w-full resize-none rounded-lg border-0 px-4 py-3 text-sm font-medium text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 transition-all duration-200 focus:ring-2 focus:ring-inset focus:ring-[#a20202] sm:leading-6">{{ $user->address ?? '-' }}</textarea>
                                </div>

                                <div class="space-y-2">
                                    <label class="ml-1 block text-sm font-extrabold uppercase text-black">
                                        Metode Pembayaran
                                    </label>
                                    <div class="relative">
                                        <select id="payment_method" name="payment_method"
                                            class="block w-full rounded-lg border-0 px-4 py-3 text-sm font-bold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 transition-all duration-200 focus:ring-2 focus:ring-inset focus:ring-[#a20202] sm:leading-6"
                                            required>
                                            @foreach ($paymentMethods as $paymentMethod)
                                                <option value="{{ $paymentMethod->code }}"
                                                    @selected($selectedPaymentMethod?->id === $paymentMethod->id)>
                                                    {{ $paymentMethod->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <svg class="pointer-events-none absolute right-4 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 flex items-center justify-between gap-2">
                            <a href="{{ route('profile.edit') }}#atur-alamat"
                                class="rounded-full bg-[#a20202] px-6 py-2.5 text-[12px] font-black uppercase tracking-widest text-white shadow-lg transition-all hover:scale-105 hover:bg-[#8a0202]">
                                UBAH TUJUAN
                            </a>
                            <button type="submit"
                                class="rounded-full bg-[#a20202] px-8 py-2.5 text-[14px] font-black uppercase tracking-widest text-white shadow-xl transition-all hover:scale-105 hover:bg-[#8a0202]"
                                @disabled($shippingCities->isEmpty() || $paymentMethods->isEmpty())>
                                CEK ONGKIR
                            </button>
                        </div>
                    </form>
                </div>

                <div class="flex w-full flex-col pt-12 md:w-1/2 md:pl-4 md:pt-0">
                    <div class="flex-grow">
                        <h2 class="mb-6 text-2xl font-black uppercase tracking-tight text-black underline decoration-[4px] underline-offset-8 md:text-3xl">
                            ALAMAT PENGIRIMAN
                        </h2>

                        <div class="mt-8 space-y-2 text-[17px] font-bold leading-relaxed text-black">
                            <p>{{ $user->address ?? '-' }}</p>
                            <p>
                                {{ $selectedShippingCity?->name ?? 'Kota belum dipilih' }}
                                @if ($user->postal_code)
                                    ({{ $user->postal_code }})
                                @endif
                            </p>
                        </div>

                        <div class="mt-6 h-[10px] w-full bg-black"></div>

                        <div class="mt-4 rounded-[24px] border-[2px] border-black bg-[#f8fafc] p-5 shadow-[0_4px_0_rgba(0,0,0,0.05)]">
                            <h3 class="mb-4 inline-block border-b-2 border-black pb-1.5 text-[14px] font-black uppercase tracking-widest text-black">
                                RINCIAN PEMBAYARAN
                            </h3>

                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-[13px] font-bold text-[#4b5563]">Subtotal Produk</span>
                                    <span class="text-[14px] font-bold text-black">
                                        Rp {{ number_format($cartTotal, 0, '.', '.') }}
                                    </span>
                                </div>

                                <div class="flex items-center justify-between">
                                    <span class="text-[13px] font-bold text-[#4b5563]">Biaya Ongkir</span>
                                    <span class="text-[14px] font-bold text-black">
                                        Rp {{ number_format($shippingCost, 0, '.', '.') }}
                                    </span>
                                </div>

                                <div class="flex items-center justify-between rounded-lg border border-black/5 bg-gray-200 p-3">
                                    <div class="flex items-center gap-2">
                                        <svg class="h-3.5 w-3.5 text-[#1e40af]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                                        <span class="text-[11px] font-black uppercase text-[#6b7280]">Metode Pembayaran</span>
                                    </div>
                                    <span class="text-[13px] font-black text-[#1e40af]">{{ $selectedPaymentMethod?->name ?? '-' }}</span>
                                </div>

                                <div class="mt-1 flex items-end justify-between border-t-2 border-black pt-3">
                                    <span class="mb-1.5 text-[12px] font-black uppercase tracking-widest text-[#6b7280]">Total Bayar</span>
                                    <div class="flex items-baseline gap-1">
                                        <span class="text-[16px] font-black text-[#a20202]">Rp</span>
                                        <span class="text-[28px] font-black leading-none tracking-tighter text-[#a20202]">
                                            {{ number_format($grandTotal, 0, '.', '.') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end pb-8">
                        <button type="button"
                            class="rounded-full bg-[#a20202] px-10 py-2.5 text-[15px] font-black uppercase tracking-widest text-white shadow-xl transition-all hover:scale-105 hover:bg-[#8a0202] disabled:cursor-not-allowed disabled:bg-gray-400"
                            @disabled($cart->items->isEmpty())>
                            SIMPAN
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
