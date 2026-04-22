<x-admin-layout>
    <x-slot name="header">
        Katalog Produk
    </x-slot>


    <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm sm:p-5">
        <div class="js-table-actions flex items-center justify-between">
            <a href="{{ route('admin.products.create') }}" class="inline-flex items-center justify-center rounded-lg bg-[#A20202] px-4 py-2 text-sm font-semibold text-white hover:bg-[#870101]">
                + Tambah Produk
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="js-admin-datatable min-w-full whitespace-nowrap" data-page-length="10">
                <thead>
                    <tr class="border-y border-gray-200 bg-gray-50 text-left text-xs font-bold uppercase tracking-wide text-gray-500">
                        <th class="no-sort w-10 px-4 py-3 text-center">No.</th>
                        <th class="px-4 py-3">Produk</th>
                        <th class="px-4 py-3">Kategori</th>
                        <th class="px-4 py-3">SKU</th>
                        <th class="px-4 py-3">Harga</th>
                        <th class="px-4 py-3">Stok</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                    @foreach ($products as $product)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 text-center font-medium text-gray-400">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    @if ($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-11 w-11 rounded-lg border border-gray-200 object-cover">
                                    @else
                                        <div class="flex h-11 w-11 items-center justify-center rounded-lg border border-dashed border-gray-300 text-gray-400">-</div>
                                    @endif
                                    <div>
                                        <p class="font-semibold text-gray-800">{{ $product->name }}</p>
                                        <p class="text-xs text-gray-500">ID: {{ $product->id }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3">{{ $product->category?->name ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $product->sku }}</td>
                            <td class="px-4 py-3 font-semibold">Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                            <td class="px-4 py-3">
                                <span class="rounded-md px-2 py-1 text-xs font-semibold {{ $product->stock > 0 ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-700' }}">
                                    {{ $product->stock }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="rounded-md border border-gray-300 px-3 py-1.5 text-xs font-semibold text-gray-700 hover:bg-gray-50">Edit</a>
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="rounded-md border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-700 hover:bg-red-100">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
