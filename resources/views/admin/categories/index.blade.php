<x-admin-layout>
    <x-slot name="header">
        Kelola Kategori
    </x-slot>

    @if (session('success'))
        <div class="mb-4 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm sm:p-5">
        <div class="mb-4 flex items-center justify-between">
            <a href="{{ route('admin.categories.create') }}" class="inline-flex items-center justify-center rounded-lg bg-[#A20202] px-4 py-2 text-sm font-semibold text-white hover:bg-[#870101]">
                + Tambah Kategori
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="js-admin-datatable min-w-full whitespace-nowrap" data-page-length="10">
                <thead>
                    <tr class="border-y border-gray-200 bg-gray-50 text-left text-xs font-bold uppercase tracking-wide text-gray-500">
                        <th class="px-4 py-3">Nama Kategori</th>
                        <th class="px-4 py-3">Slug</th>
                        <th class="px-4 py-3">Jumlah Produk</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                    @foreach ($categories as $category)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 font-semibold text-gray-800">{{ $category->name }}</td>
                            <td class="px-4 py-3 text-gray-500">{{ $category->slug }}</td>
                            <td class="px-4 py-3">
                                <span class="rounded-md bg-gray-100 px-2 py-1 text-xs font-semibold text-gray-700">
                                    {{ $category->products_count }} produk
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.categories.edit', $category) }}" class="rounded-md border border-gray-300 px-3 py-1.5 text-xs font-semibold text-gray-700 hover:bg-gray-50">Edit</a>
                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini?');">
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
