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
            </div>
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
                                <option value="{{ $statusOption }}" @selected($order->status === $statusOption)>
                                    {{ strtoupper($statusOption) }}
                                </option>
                            @endforeach
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                <button type="submit" class="w-full rounded-lg bg-[#A20202] px-4 py-2 text-sm font-semibold text-white hover:bg-[#870101]">
                    Simpan Status
                    </button>
                </form>

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
