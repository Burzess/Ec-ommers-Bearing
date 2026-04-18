<x-app-layout>
    <div class="min-h-screen bg-white py-4 px-3 sm:px-4 md:py-4 font-['Poppins']">
        <div class="max-w-[1100px] mx-auto relative" x-data='{
            selectedItems: [],
            itemTotals: {
                @foreach($cart->items as $item)
                    {{ $item->id }}: {{ $item->product->price * $item->quantity }}@if(!$loop->last),@endif
                @endforeach
            },
            selectedGrandTotal() {
                return this.selectedItems.reduce((sum, id) => sum + (this.itemTotals[id] || 0), 0);
            },
            formatRupiah(amount) {
                return new Intl.NumberFormat("id-ID").format(amount || 0);
            }
        }'>

            @if($cart->items->count() > 0)
                <div class="flex flex-col md:flex-row">
                    <!-- Left Column -->
                    <div class="w-full md:w-[62%] md:pr-8 md:border-r-[5px] border-black flex flex-col pt-4">
                        <h1
                            class="mb-6 text-2xl md:text-3xl font-black uppercase underline decoration-[4px] underline-offset-8 text-black tracking-tight">
                            KERANJANG SAYA
                        </h1>

                        <div class="flex flex-col gap-5">
                            @foreach($cart->items as $item)
                                <div class="grid grid-cols-1 sm:grid-cols-[1fr_auto] items-center gap-4 sm:gap-4">
                                    <!-- Product Box -->
                                    <div
                                        class="group flex items-center w-full border-[3px] border-black rounded-[32px] px-4 py-3 bg-white relative shadow-[0_4px_0_rgba(0,0,0,0.08)] transition">
                                        <!-- Delete Button -->
                                        <form action="{{ route('cart.destroy', $item) }}" method="POST"
                                            class="absolute -top-3 -left-3 sm:-left-3 sm:-right-auto">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="flex h-9 w-9 items-center justify-center bg-white border-[3px] border-black rounded-full text-red-600 hover:bg-red-50 transition shadow-sm z-10"
                                                title="Hapus">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="3"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </form>

                                        <div
                                            class="w-[92px] h-[92px] shrink-0 border-2 border-[#d6dbe4] rounded-[22px] flex items-center justify-center p-2 bg-[#f3f4f6]">
                                            @if($item->product->image)
                                                <img src="{{ asset('storage/' . $item->product->image) }}"
                                                    class="w-full h-full object-contain mix-blend-multiply">
                                            @endif
                                        </div>
                                        <div class="ml-5 flex flex-col justify-center w-full pr-2">
                                            <a href="{{ route('products.show', $item->product) }}"
                                                class="font-extrabold text-black text-[16px] leading-[1.1] sm:text-[17px] hover:text-[#a20202]">
                                                {{ $item->product->name }}
                                            </a>
                                            <div class="text-[14px] sm:text-[15px] font-black text-black mt-2 tracking-tight">
                                                <span class="text-[12px] font-extrabold mr-1">Rp</span>
                                                {{ number_format($item->product->price, 0, '.', '.') }}
                                            </div>
                                            <div
                                                class="text-[13px] sm:text-[14px] font-bold text-[#374151] mt-1.5 tracking-tight">
                                                <span class="text-[11px] font-extrabold mr-1 uppercase">Total</span>
                                                Rp {{ number_format($item->product->price * $item->quantity, 0, '.', '.') }}
                                            </div>
                                            <div class="mt-2.5 flex items-center gap-3">
                                                <div
                                                    class="text-[9px] font-extrabold text-[#6b7280] uppercase tracking-[0.16em]">
                                                    KUANTITAS</div>
                                                <div
                                                    class="shrink-0 flex items-center border-2 border-[#98a2b3] rounded-full bg-[#f8fafc] px-2 py-1 gap-2">
                                                    <form action="{{ route('cart.update', $item) }}" method="POST"
                                                        class="inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="quantity" value="{{ $item->quantity - 1 }}">
                                                        <button type="submit"
                                                            class="flex items-center justify-center w-6 h-6 text-[#6b7280] hover:text-black transition"
                                                            @if($item->quantity <= 1) disabled @endif>
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                                stroke-width="2" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M20 12H4"></path>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                    <span
                                                        class="w-8 text-center text-[13px] font-extrabold text-black">{{ $item->quantity }}</span>
                                                    <form action="{{ route('cart.update', $item) }}" method="POST"
                                                        class="inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                                                        <button type="submit"
                                                            class="flex items-center justify-center w-6 h-6 text-[#6b7280] hover:text-black transition">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                                stroke-width="2" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M12 4v16m8-8H4"></path>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="shrink-0 mt-1 sm:mt-0 sm:justify-self-end px-4">
                                        <input type="checkbox"
                                            @change="$event.target.checked ? (!selectedItems.includes({{ $item->id }}) && selectedItems.push({{ $item->id }})) : selectedItems = selectedItems.filter(id => id !== {{ $item->id }})"
                                            :checked="selectedItems.includes({{ $item->id }})"
                                            class="h-6 w-6 rounded border-2 border-[#98a2b3] text-[#a20202] focus:ring-[#a20202] cursor-pointer">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="w-full md:w-[38%] md:pl-8 mt-8 md:mt-0 flex flex-col items-start pt-4">
                        <div class="sticky top-6 w-full">
                            <h2
                                class="mb-6 text-2xl md:text-3xl font-black uppercase underline decoration-[4px] underline-offset-8 text-black tracking-tight">
                                TOTAL BELANJA
                            </h2>
                            <div
                                class="w-full rounded-[32px] border-[3px] border-black bg-white px-6 py-5 shadow-[0_4px_0_rgba(0,0,0,0.08)]">
                                
                                <div class="mb-6 space-y-3">
                                    <p class="text-[12px] text-center font-black uppercase tracking-[0.14em] text-black ">
                                        Isi Barang Terpilih
                                    </p>
                                    <div class="max-h-[220px] overflow-y-auto pr-2 custom-scrollbar space-y-3 bg-gray-100 p-4 rounded-[24px] border-2 border-black/5 shadow-inner">
                                        @foreach($cart->items as $item)
                                            <div x-show="selectedItems.includes({{ $item->id }})" x-cloak class="flex justify-between items-center gap-4 pb-2 border-b border-black/5 last:border-0 h-auto min-h-[40px]">
                                                <span class="flex-1 text-[14px] font-bold text-black leading-tight line-clamp-1">{{ $item->product->name }}</span>
                                                <span class="text-[13px] font-black text-white bg-[#a20202] px-3 py-1 rounded-full shrink-0 ml-auto whitespace-nowrap">x {{ $item->quantity }}</span>
                                            </div>
                                        @endforeach
                                        <div x-show="selectedItems.length === 0" class="text-[12px] font-bold text-[#9ca3af] italic text-center py-2">
                                            Pilih barang untuk melihat ringkasan
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <div class="mb-1 flex items-center justify-between gap-3">
                                        <p class="text-[11px] font-bold uppercase tracking-[0.14em] text-[#6b7280]">
                                            Total Dipilih
                                        </p>
                                        <p class="text-[11px] font-bold uppercase tracking-[0.12em] text-[#4b5563]"
                                            x-text="selectedItems.length > 0 ? selectedItems.length + ' ITEM DIPILIH' : '0 ITEM DIPILIH'">
                                        </p>
                                    </div>
                                    <p class="text-[24px] font-black text-black leading-none"
                                        x-text="'Rp ' + formatRupiah(selectedGrandTotal())"></p>
                                </div>

                                <button x-show="selectedItems.length === 0" disabled
                                    class="w-full bg-[#9ca3af] text-white font-extrabold px-8 py-3 rounded-full text-[14px] shadow-md transition uppercase tracking-wider cursor-not-allowed text-center">
                                    BELUM ADA ITEM DIPILIH
                                </button>

                                <button x-show="selectedItems.length > 0" style="display: none;"
                                    @click.prevent="$dispatch('open-modal', 'payment-method-modal')"
                                    class="w-full bg-[#a20202] text-white font-extrabold px-8 py-3 rounded-full hover:bg-[#8a0202] focus:outline-none focus:ring-4 focus:ring-red-300 text-[14px] shadow-lg transition uppercase tracking-wider text-center">
                                    LANJUT PEMBAYARAN
                                </button>

                                <button x-show="selectedItems.length > 0" style="display: none;"
                                    @click.prevent="selectedItems = []"
                                    class="mt-3 w-full border-2 border-[#a20202] text-[#a20202] font-extrabold px-8 py-2.5 rounded-full hover:bg-[#fff5f5] text-[13px] transition uppercase tracking-wider text-center">
                                    RESET
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            @else
                <!-- Empty Cart -->
                <div
                    class="bg-gray-50 rounded-[30px] p-10 text-center border-[3px] border-dashed border-gray-300 max-w-2xl mx-auto mt-10">
                    <p class="text-[24px] font-extrabold text-gray-400 uppercase">Keranjang Kosong</p>
                    <a href="{{ route('dashboard') }}"
                        class="mt-6 inline-block bg-[#a20202] text-white font-extrabold py-3 px-8 rounded-full hover:bg-opacity-90 transition shadow-lg">
                        Mulai Belanja
                    </a>
                </div>
            @endif
        </div>

        <!-- MODAL METODE PEMBAYARAN -->
        <x-modal name="payment-method-modal" maxWidth="sm" positionY="center" positionClass="my-6" focusable>
            <div class="w-full bg-[#f0f0f0] p-8 sm:p-10 relative">
                <button x-on:click="$dispatch('close')"
                    class="absolute top-4 right-5 text-gray-500 hover:text-black font-bold text-2xl transition">&times;</button>

                <div class="border-b-[3px] border-black pb-1 mb-8 w-fit mx-auto">
                    <h2 class="text-center text-[16px] font-extrabold text-black uppercase tracking-wide">
                        METODE PEMBAYARAN
                    </h2>
                </div>

                <form method="GET" action="{{ route('payment.index') }}" class="flex flex-col gap-6 max-w-[280px] mx-auto">
                    @forelse ($paymentMethods as $paymentMethod)
                        <label class="flex items-center gap-4 cursor-pointer group">
                            <div class="relative flex items-center justify-center shrink-0">
                                <input type="radio" name="payment_method" value="{{ $paymentMethod->code }}" class="peer sr-only"
                                    @checked($loop->first)>
                                <div
                                    class="w-[26px] h-[26px] rounded-full border-[3px] border-[#1e40af] bg-transparent peer-checked:bg-[#1e40af] peer-checked:border-[#1e40af] transition overflow-hidden">
                                </div>
                                <div
                                    class="absolute inset-0 m-auto w-2.5 h-2.5 rounded-full bg-white opacity-0 peer-checked:opacity-100 transition">
                                </div>
                            </div>
                            <div>
                                <p class="font-extrabold text-[15px] text-black peer-checked:text-[#1e40af] group-hover:text-[#1e40af] transition">
                                    {{ $paymentMethod->name }}
                                </p>
                                @if ($paymentMethod->description)
                                    <p class="text-xs font-medium text-gray-500">{{ $paymentMethod->description }}</p>
                                @endif
                            </div>
                        </label>
                    @empty
                        <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-medium text-red-700">
                            Belum ada metode pembayaran aktif.
                        </div>
                    @endforelse

                    <div class="mt-8 flex justify-center">
                        <button type="submit"
                            class="bg-[#a20202] text-white font-extrabold px-12 py-2.5 rounded-full hover:bg-[#8a0202] shadow-xl transition text-[14px] disabled:cursor-not-allowed disabled:bg-gray-400"
                            @disabled($paymentMethods->isEmpty())>
                            LANJUTKAN
                        </button>
                    </div>
                </form>
            </div>
        </x-modal>
    </div>

    <style>
        /* Optional fix for Safari/Firefox overriding border colors */
        .peer:checked~div:first-of-type {
            border-color: #1e40af !important;
            background-color: transparent !important;
        }

        .peer:checked~div:last-child {
            background-color: #1e40af !important;
        }

        /* Active option should be blue on the clicked/checked radio */
        label.group:has(input:checked) span {
            color: #1e40af !important;
        }

        label.group:has(input:checked) .peer~div:first-of-type {
            border-color: #1e40af !important;
            background-color: transparent !important;
        }

        label.group:has(input:checked) .peer~div:last-child {
            opacity: 1 !important;
            background-color: #1e40af !important;
        }
    </style>
</x-app-layout>