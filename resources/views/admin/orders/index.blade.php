<x-admin-layout>
    <x-slot name="header">
        Kelola Pesanan
    </x-slot>



    <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm sm:p-5">
        <form action="{{ route('admin.orders.index') }}" method="GET" class="mb-1 grid grid-cols-1 gap-3 md:grid-cols-4">
            <div class="md:col-span-2">
                <label for="q" class="sr-only">Cari pesanan</label>
                <input id="q" name="q" type="text" value="{{ $search }}" placeholder="Cari invoice / nama / email pelanggan..." class="w-full rounded-lg border-gray-300 text-sm focus:border-[#A20202] focus:ring-[#A20202]">
            </div>

            <div>
                <label for="status" class="sr-only">Status</label>
                <select id="status" name="status" class="w-full rounded-lg border-gray-300 text-sm focus:border-[#A20202] focus:ring-[#A20202]">
                    <option value="">Semua Status</option>
                    @foreach ($statuses as $statusOption)
                        <option value="{{ $statusOption }}" @selected($status === $statusOption)>
                            {{ strtoupper($statusOption) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex gap-2">
                <button type="submit" class="w-full rounded-lg bg-[#A20202] px-4 py-2 text-sm font-semibold text-white hover:bg-[#870101]">Filter</button>
                <a href="{{ route('admin.orders.index') }}" class="w-full rounded-lg border border-gray-300 px-4 py-2 text-center text-sm font-semibold text-gray-700 hover:bg-gray-50">Reset</a>
            </div>
        </form>

        <div class="overflow-x-auto">
            <table class="js-admin-datatable min-w-full whitespace-nowrap" data-page-length="10" data-searching="false">
                <thead>
                    <tr class="border-y border-gray-200 bg-gray-50 text-left text-xs font-bold uppercase tracking-wide text-gray-500">
                        <th class="no-sort px-4 py-3">No.</th>
                        <th class="px-4 py-3">Invoice</th>
                        <th class="px-4 py-3">Pelanggan</th>
                        <th class="px-4 py-3">Total</th>
                        <th class="px-4 py-3">Item</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                    @forelse ($orders as $order)
                        @php
                            $statusClasses = [
                                'pending' => 'bg-yellow-50 text-yellow-700',
                                'paid' => 'bg-blue-50 text-blue-700',
                                'shipped' => 'bg-indigo-50 text-indigo-700',
                                'completed' => 'bg-green-50 text-green-700',
                                'cancelled' => 'bg-red-50 text-red-700',
                            ];
                            $badgeClass = $statusClasses[$order->status] ?? 'bg-gray-50 text-gray-700';
                        @endphp

                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 text-gray-500">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 font-semibold text-gray-800">#{{ $order->invoice_number }}</td>
                            <td class="px-4 py-3">
                                <p class="font-semibold text-gray-800">{{ $order->user?->name ?? '-' }}</p>
                                <p class="text-xs text-gray-500">{{ $order->user?->email ?? '-' }}</p>
                            </td>
                            <td class="px-4 py-3 font-semibold">Rp{{ number_format((float) $order->total_price, 0, ',', '.') }}</td>
                            <td class="px-4 py-3">{{ $order->items_count }} item</td>
                            <td class="px-4 py-3">
                                <span class="rounded-md px-2.5 py-1 text-xs font-bold {{ $badgeClass }}">{{ strtoupper($order->status) }}</span>
                            </td>
                            <td class="px-4 py-3 text-xs text-gray-500">{{ $order->created_at->translatedFormat('d M Y H:i') }}</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.orders.show', $order) }}" class="rounded-md border border-gray-300 px-3 py-1.5 text-xs font-semibold text-gray-700 hover:bg-gray-50">Detail</a>
                                    <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pesanan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="rounded-md border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-700 hover:bg-red-100">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-8 text-center text-sm text-gray-500">
                                Belum ada data pesanan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-admin-layout>
