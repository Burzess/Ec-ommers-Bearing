<x-app-layout>
    @php
        $statusLabels = [
            'pending' => 'Menunggu Pembayaran',
            'paid' => 'Sudah Dibayar',
            'shipped' => 'Sedang Dikirim',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
        ];

        $statusClasses = [
            'pending' => 'bg-yellow-100 text-yellow-800',
            'paid' => 'bg-blue-100 text-blue-800',
            'shipped' => 'bg-indigo-100 text-indigo-800',
            'completed' => 'bg-green-100 text-green-800',
            'cancelled' => 'bg-red-100 text-red-800',
        ];

        $subtotal = (float) $order->subtotal_price;

        if ($subtotal <= 0) {
            $subtotal = (float) $order->items->sum(function ($item): float {
                return ((float) $item->price) * (int) $item->quantity;
            });
        }

        $shippingCost = (float) $order->shipping_cost;

        if ($shippingCost <= 0 && (float) $order->total_price > $subtotal) {
            $shippingCost = (float) $order->total_price - $subtotal;
        }

        $statusLabel = $statusLabels[$order->status] ?? strtoupper($order->status);
        $statusClass = $statusClasses[$order->status] ?? 'bg-gray-100 text-gray-800';
    @endphp

    <div class="bg-white py-6 sm:py-8 font-['Poppins']">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
            <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
                <div>
                    <h1 class="text-2xl font-black uppercase tracking-tight text-black md:text-3xl">
                        Detail Pesanan
                    </h1>
                    <p class="mt-1 text-sm font-medium text-gray-600">
                        Invoice {{ $order->invoice_number }}
                    </p>
                </div>

                <span class="inline-flex rounded-full px-4 py-1.5 text-xs font-black uppercase tracking-wide {{ $statusClass }}">
                    {{ $statusLabel }}
                </span>
            </div>

            <div class="grid gap-6 lg:grid-cols-[1.2fr_1fr]">
                <section class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm sm:p-6">
                    <h2 class="mb-4 text-sm font-black uppercase tracking-[0.12em] text-gray-700">Item Pesanan</h2>

                    <div class="overflow-x-auto">
                        <table class="min-w-full whitespace-nowrap">
                            <thead>
                                <tr class="border-y border-gray-200 bg-gray-50 text-left text-xs font-bold uppercase tracking-wide text-gray-500">
                                    <th class="px-3 py-2">Produk</th>
                                    <th class="px-3 py-2">Harga</th>
                                    <th class="px-3 py-2">Qty</th>
                                    <th class="px-3 py-2">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                                @forelse ($order->items as $item)
                                    <tr>
                                        <td class="px-3 py-3">
                                            <p class="font-bold text-gray-900">{{ $item->product?->name ?? 'Produk tidak ditemukan' }}</p>
                                            <p class="text-xs text-gray-500">{{ $item->product?->sku ?? '-' }}</p>
                                        </td>
                                        <td class="px-3 py-3">Rp {{ number_format((float) $item->price, 0, '.', '.') }}</td>
                                        <td class="px-3 py-3">{{ $item->quantity }}</td>
                                        <td class="px-3 py-3 font-semibold">Rp {{ number_format((float) $item->price * $item->quantity, 0, '.', '.') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-3 py-6 text-center text-sm text-gray-500">
                                            Item pesanan tidak tersedia.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <aside class="space-y-6">
                    <section class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm sm:p-6">
                        <h2 class="mb-3 text-sm font-black uppercase tracking-[0.12em] text-gray-700">Informasi Pembayaran</h2>

                        <div class="space-y-2 text-sm font-medium text-gray-700">
                            <div class="flex items-center justify-between gap-3">
                                <span>Metode</span>
                                <span class="text-right font-bold text-gray-900">{{ $order->payment_method_name ?? '-' }}</span>
                            </div>

                            @if ($order->payment_instruction)
                                <div class="rounded-xl border border-blue-100 bg-blue-50 p-3 text-xs leading-relaxed text-blue-900">
                                    {{ $order->payment_instruction }}
                                </div>
                            @endif

                            @if ($order->isCodPayment())
                                <div class="rounded-xl border border-amber-200 bg-amber-50 p-3 text-xs leading-relaxed text-amber-900">
                                    Pesanan ini menggunakan COD. Pembayaran dilakukan saat barang diterima buyer.
                                </div>
                            @endif

                            @if ($order->isTransferPayment())
                                @if ($order->payment_proof_path)
                                    <div class="rounded-xl border border-gray-200 bg-gray-50 p-3">
                                        <p class="text-xs font-bold uppercase tracking-wide text-gray-500">Bukti Transfer</p>
                                        <a href="{{ asset('storage/' . $order->payment_proof_path) }}" target="_blank" rel="noopener noreferrer" class="mt-2 block">
                                            <img src="{{ asset('storage/' . $order->payment_proof_path) }}" alt="Bukti transfer {{ $order->invoice_number }}" class="h-44 w-full rounded-lg object-cover ring-1 ring-gray-200">
                                        </a>
                                        <p class="mt-2 text-xs text-gray-500">
                                            Diunggah: {{ $order->payment_proof_uploaded_at?->translatedFormat('d M Y, H:i') ?? '-' }}
                                        </p>

                                        @if ($order->payment_verified_at)
                                            <p class="mt-1 text-xs font-semibold text-green-700">
                                                Sudah diverifikasi admin pada {{ $order->payment_verified_at->translatedFormat('d M Y, H:i') }}.
                                            </p>
                                        @elseif ($order->status === \App\Models\Order::STATUS_PENDING)
                                            <p class="mt-1 text-xs font-semibold text-amber-700">
                                                Menunggu verifikasi admin.
                                            </p>
                                        @endif
                                    </div>
                                @endif

                                @if ($order->canUploadTransferProof())
                                    <form method="POST" action="{{ route('orders.payment-proof.store', $order) }}" enctype="multipart/form-data" class="rounded-xl border border-gray-200 bg-white p-3">
                                        @csrf
                                        <label for="payment_proof" class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Upload Bukti Transfer</label>
                                        <input id="payment_proof" name="payment_proof" type="file" accept="image/png,image/jpeg,image/webp"
                                            class="block w-full rounded-lg border-gray-300 text-sm focus:border-[#A20202] focus:ring-[#A20202]" required>
                                        @error('payment_proof')
                                            <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p>
                                        @enderror

                                        <button type="submit" class="mt-3 w-full rounded-lg bg-[#A20202] px-4 py-2 text-xs font-bold uppercase tracking-wide text-white hover:bg-[#870101]">
                                            {{ $order->payment_proof_path ? 'Upload Ulang Bukti Transfer' : 'Kirim Bukti Transfer' }}
                                        </button>
                                    </form>
                                @endif

                                @if ($order->payment_verification_note)
                                    <div class="rounded-xl border border-red-200 bg-red-50 p-3 text-xs leading-relaxed text-red-700">
                                        Catatan Admin: {{ $order->payment_verification_note }}
                                    </div>
                                @endif
                            @endif
                        </div>
                    </section>

                    <section class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm sm:p-6">
                        <h2 class="mb-3 text-sm font-black uppercase tracking-[0.12em] text-gray-700">Alamat Pengiriman</h2>

                        <div class="space-y-1.5 text-sm text-gray-700">
                            <p class="font-semibold text-gray-900">{{ $order->shipping_city_name ?? '-' }}</p>
                            <p>{{ $order->shipping_address ?? '-' }}</p>
                            <p>Telepon: {{ $order->shipping_phone ?? '-' }}</p>
                            @if ($order->shipping_postal_code)
                                <p>Kode Pos: {{ $order->shipping_postal_code }}</p>
                            @endif
                        </div>
                    </section>

                    <section class="rounded-2xl border border-black bg-gray-50 p-5 shadow-sm sm:p-6">
                        <h2 class="mb-3 text-sm font-black uppercase tracking-[0.12em] text-gray-700">Ringkasan Tagihan</h2>

                        <div class="space-y-2 text-sm font-semibold text-gray-700">
                            <div class="flex items-center justify-between">
                                <span>Subtotal Produk</span>
                                <span>Rp {{ number_format($subtotal, 0, '.', '.') }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span>Biaya Ongkir</span>
                                <span>Rp {{ number_format($shippingCost, 0, '.', '.') }}</span>
                            </div>
                            <div class="mt-2 flex items-center justify-between border-t-2 border-black pt-2">
                                <span class="text-xs font-black uppercase tracking-widest text-gray-600">Total Bayar</span>
                                <span class="text-lg font-black text-[#a20202]">Rp {{ number_format((float) $order->total_price, 0, '.', '.') }}</span>
                            </div>
                        </div>
                    </section>
                </aside>
            </div>

            <div class="mt-6">
                <a href="{{ route('profile.edit') }}#riwayat-pembelian"
                    class="inline-flex items-center rounded-lg border border-gray-300 px-4 py-2 text-sm font-bold text-gray-700 transition hover:bg-gray-100">
                    Kembali ke Riwayat Pembelian
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
