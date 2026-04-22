<x-admin-layout>
    <x-slot name="header">
        Ongkir Kota
    </x-slot>



    <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm sm:p-5">
        <div class="js-table-actions flex items-center justify-between">
            <a href="{{ route('admin.shipping-cities.create') }}" class="inline-flex items-center justify-center rounded-lg bg-[#A20202] px-4 py-2 text-sm font-semibold text-white hover:bg-[#870101]">
                + Tambah Kota
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="js-admin-datatable min-w-full whitespace-nowrap" data-page-length="10">
                <thead>
                    <tr class="border-y border-gray-200 bg-gray-50 text-left text-xs font-bold uppercase tracking-wide text-gray-500">
                        <th class="no-sort px-4 py-3">No.</th>
                        <th class="px-4 py-3">Kota / Kabupaten</th>
                        <th class="px-4 py-3">Slug</th>
                        <th class="px-4 py-3">Biaya Ongkir</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Dipakai User</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                    @forelse ($shippingCities as $shippingCity)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 text-gray-500">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 font-semibold text-gray-800">{{ $shippingCity->name }}</td>
                            <td class="px-4 py-3 text-gray-500">{{ $shippingCity->slug }}</td>
                            <td class="px-4 py-3 font-semibold">Rp{{ number_format((float) $shippingCity->shipping_cost, 0, ',', '.') }}</td>
                            <td class="px-4 py-3">
                                @if ($shippingCity->is_active)
                                    <span class="rounded-md bg-green-50 px-2 py-1 text-xs font-semibold text-green-700">Aktif</span>
                                @else
                                    <span class="rounded-md bg-gray-100 px-2 py-1 text-xs font-semibold text-gray-700">Nonaktif</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">{{ $shippingCity->users_count }} user</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.shipping-cities.edit', $shippingCity) }}" class="rounded-md border border-gray-300 px-3 py-1.5 text-xs font-semibold text-gray-700 hover:bg-gray-50">Edit</a>
                                    <form action="{{ route('admin.shipping-cities.destroy', $shippingCity) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kota tujuan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="rounded-md border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-700 hover:bg-red-100">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-sm text-gray-500">Belum ada data kota ongkir.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-admin-layout>
