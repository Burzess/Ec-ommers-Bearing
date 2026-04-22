<x-admin-layout>
    <x-slot name="header">
        Data Pelanggan
    </x-slot>


    <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm sm:p-5">
        <div class="overflow-x-auto">
            <table class="js-admin-datatable min-w-full whitespace-nowrap" data-page-length="10">
                <thead>
                    <tr class="border-y border-gray-200 bg-gray-50 text-left text-xs font-bold uppercase tracking-wide text-gray-500">
                        <th class="no-sort px-4 py-3">No.</th>
                        <th class="px-4 py-3">Nama</th>
                        <th class="px-4 py-3">Kontak</th>
                        <th class="px-4 py-3">Alamat</th>
                        <th class="px-4 py-3">Total Pesanan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                    @foreach ($customers as $customer)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 text-gray-500">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3">
                                <p class="font-semibold text-gray-800">{{ $customer->name }}</p>
                                <p class="text-xs text-gray-500">{{ $customer->username ?: '-' }}</p>
                            </td>
                            <td class="px-4 py-3">
                                <p>{{ $customer->email }}</p>
                                <p class="text-xs text-gray-500">{{ $customer->phone ?: '-' }}</p>
                            </td>
                            <td class="px-4 py-3 text-gray-600">{{ $customer->address ?: '-' }}</td>
                            <td class="px-4 py-3">
                                <span class="rounded-md bg-gray-100 px-2 py-1 text-xs font-semibold text-gray-700">
                                    {{ $customer->orders_count }} pesanan
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
