<x-admin-layout>
    <x-slot name="header">
        Detail Pesanan #{{ $order->invoice_number }}
    </x-slot>

    <div class="mb-6 grid grid-cols-1 gap-6 lg:grid-cols-3">
        <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm lg:col-span-2">
            <h3 class="mb-4 text-lg font-bold text-gray-800">Informasi Pesanan</h3>

            <div class="grid grid-cols-1 gap-4 text-sm sm:grid-cols-2">
                    <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Invoice</p>
                    <p class="mt-1 font-semibold text-gray-800">#{{ $order->invoice_number }}</p>
                    </div>
                    <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Tanggal</p>
                    <p class="mt-1 font-semibold text-gray-800">{{ $order->created_at->translatedFormat('d F Y, H:i') }}</p>
                    </div>
                    <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Pelanggan</p>
                    <p class="mt-1 font-semibold text-gray-800">{{ $order->user?->name ?? '-' }}</p>
                    <p class="text-xs text-gray-500">{{ $order->user?->email ?? '-' }}</p>
                    </div>
                    <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Total Tagihan</p>
                    <p class="mt-1 text-lg font-bold text-[#A20202]">Rp{{ number_format((float) $order->total_price, 0, ',', '.') }}</p>
                </div>
                    <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Metode Pembayaran</p>
                    <p class="mt-1 font-semibold text-gray-800">{{ $order->payment_method_name ?? '-' }}</p>
                    <p class="text-xs text-gray-500">{{ $order->payment_method_code ?? '-' }}</p>
                    </div>
                    <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Ongkir</p>
                    <p class="mt-1 font-semibold text-gray-800">Rp{{ number_format((float) $order->shipping_cost, 0, ',', '.') }}</p>
                    </div>
            </div>

            <div class="mt-4 rounded-lg border border-gray-100 bg-gray-50 p-3 text-sm text-gray-700">
                <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Alamat Pengiriman</p>
                <p class="mt-1 font-semibold text-gray-800">{{ $order->shipping_city_name ?? '-' }}</p>
                <p>{{ $order->shipping_address ?? '-' }}</p>
                <p>Telepon: {{ $order->shipping_phone ?? '-' }}</p>
                @if ($order->shipping_postal_code)
                    <p>Kode Pos: {{ $order->shipping_postal_code }}</p>
                @endif
            </div>

            @if ($order->isTransferPayment())
                <div class="mt-4 rounded-lg border border-blue-100 bg-blue-50 p-4 text-sm text-blue-900">
                    <p class="text-xs font-semibold uppercase tracking-wide text-blue-700">Bukti Transfer Buyer</p>

                    @if ($order->payment_proof_path)
                        <a href="{{ asset('storage/' . $order->payment_proof_path) }}" target="_blank" rel="noopener noreferrer" class="mt-2 block">
                            <img src="{{ asset('storage/' . $order->payment_proof_path) }}" alt="Bukti transfer {{ $order->invoice_number }}" class="h-56 w-full rounded-lg object-cover ring-1 ring-blue-200">
                        </a>

                        <p class="mt-2 text-xs text-blue-800">
                            Diunggah pada {{ $order->payment_proof_uploaded_at?->translatedFormat('d M Y, H:i') ?? '-' }}
                        </p>

                        @if ($order->payment_verified_at)
                            <p class="mt-1 text-xs font-semibold text-green-700">
                                Diverifikasi pada {{ $order->payment_verified_at->translatedFormat('d M Y, H:i') }}
                                oleh {{ $order->paymentVerifier?->name ?? 'Admin' }}.
                            </p>
                        @endif
                    @else
                        <p class="mt-2 text-sm font-semibold text-amber-700">Buyer belum mengunggah bukti transfer.</p>
                    @endif

                    @if ($order->payment_verification_note)
                        <div class="mt-2 rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-xs text-red-700">
                            Catatan Review: {{ $order->payment_verification_note }}
                        </div>
                    @endif
                </div>
            @elseif ($order->isCodPayment())
                <div class="mt-4 rounded-lg border border-amber-200 bg-amber-50 p-4 text-sm text-amber-800">
                    Pesanan ini menggunakan COD. Tidak memerlukan bukti transfer dari buyer.
                </div>
            @endif
        </div>

        <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
            <h3 class="mb-4 text-lg font-bold text-gray-800">Perbarui Status</h3>

                <form action="{{ route('admin.orders.update', $order) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                    <label for="status" class="mb-1 block text-sm font-semibold text-gray-700">Status Pesanan</label>
                    <select id="status" name="status" class="w-full rounded-lg border-gray-300 text-sm focus:border-[#A20202] focus:ring-[#A20202]">
                            @foreach ($statuses as $statusOption)
                                <option
                                    value="{{ $statusOption }}"
                                    @selected($order->status === $statusOption)
                                    @disabled($statusOption === \App\Models\Order::STATUS_PAID && $order->isTransferPayment() && ! $order->payment_proof_path)>
                                    {{ strtoupper($statusOption) }}
                                </option>
                            @endforeach
                        </select>
                        @if ($order->isTransferPayment() && ! $order->payment_proof_path)
                            <p class="mt-1 text-xs text-amber-700">Status PAID akan aktif setelah buyer mengunggah bukti transfer.</p>
                        @endif
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                <button type="submit" class="w-full rounded-lg bg-[#A20202] px-4 py-2 text-sm font-semibold text-white hover:bg-[#870101]">
                    Simpan Status
                    </button>
                </form>

            @if ($order->isTransferPayment() && $order->status === \App\Models\Order::STATUS_PENDING)
                <div class="mt-6 border-t border-gray-100 pt-4">
                    <h4 class="text-sm font-bold text-gray-800">Review Bukti Transfer</h4>

                    @if ($order->payment_proof_path)
                        <form action="{{ route('admin.orders.transfer-proof.review', $order) }}" method="POST" class="mt-3">
                            @csrf
                            <input type="hidden" name="action" value="verify">
                            <button type="submit" class="w-full rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700">
                                Verifikasi Pembayaran (PAID)
                            </button>
                        </form>

                        <form action="{{ route('admin.orders.transfer-proof.review', $order) }}" method="POST" class="mt-3 space-y-2">
                            @csrf
                            <input type="hidden" name="action" value="reject">
                            <label for="note" class="block text-xs font-semibold uppercase tracking-wide text-gray-500">Catatan Penolakan</label>
                            <textarea id="note" name="note" rows="3" required class="w-full rounded-lg border-gray-300 text-sm focus:border-[#A20202] focus:ring-[#A20202]" placeholder="Contoh: Nominal transfer tidak sesuai total tagihan."></textarea>
                            @error('note')
                                <p class="text-xs font-semibold text-red-600">{{ $message }}</p>
                            @enderror
                            <button type="submit" class="w-full rounded-lg border border-red-300 bg-red-50 px-4 py-2 text-sm font-semibold text-red-700 hover:bg-red-100">
                                Tolak Bukti Transfer
                            </button>
                        </form>
                    @else
                        <p class="mt-2 text-sm text-gray-500">Menunggu buyer mengunggah bukti transfer.</p>
                    @endif
                </div>
            @endif

            <div class="mt-6 border-t border-gray-100 pt-4">
                <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pesanan ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full rounded-lg border border-red-200 bg-red-50 px-4 py-2 text-sm font-semibold text-red-700 hover:bg-red-100">
                        Hapus Pesanan
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
        <h3 class="mb-4 text-lg font-bold text-gray-800">Item Pesanan</h3>

        <div class="overflow-x-auto">
            <table class="min-w-full whitespace-nowrap">
                <thead>
                    <tr class="border-y border-gray-200 bg-gray-50 text-left text-xs font-bold uppercase tracking-wide text-gray-500">
                        <th class="px-4 py-3">Produk</th>
                        <th class="px-4 py-3">SKU</th>
                        <th class="px-4 py-3">Harga</th>
                        <th class="px-4 py-3">Qty</th>
                        <th class="px-4 py-3">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                    @forelse ($order->items as $item)
                        <tr>
                            <td class="px-4 py-3">
                                <p class="font-semibold text-gray-800">{{ $item->product?->name ?? '-' }}</p>
                                <p class="text-xs text-gray-500">{{ $item->product?->category?->name ?? '-' }}</p>
                            </td>
                            <td class="px-4 py-3">{{ $item->product?->sku ?? '-' }}</td>
                            <td class="px-4 py-3">Rp{{ number_format((float) $item->price, 0, ',', '.') }}</td>
                            <td class="px-4 py-3">{{ $item->quantity }}</td>
                            <td class="px-4 py-3 font-semibold">Rp{{ number_format((float) $item->price * $item->quantity, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-8 text-center text-sm text-gray-500">
                                Tidak ada item pada pesanan ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-5 flex justify-end border-t border-gray-100 pt-4">
            <div class="rounded-lg bg-gray-50 px-4 py-3 text-sm">
                <p class="text-gray-500">Total Pembayaran</p>
                <p class="text-lg font-bold text-gray-900">Rp{{ number_format((float) $order->total_price, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center rounded-lg border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">
            Kembali ke Daftar Pesanan
        </a>
    </div>
</x-admin-layout>
