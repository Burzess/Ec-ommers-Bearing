<x-admin-layout>
    <x-slot name="header">
        Metode Pembayaran
    </x-slot>

    @if (session('success'))
        <div class="mb-4 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm sm:p-5">
        <div class="mb-4 flex items-center justify-between">
            <a href="{{ route('admin.payment-methods.create') }}" class="inline-flex items-center justify-center rounded-lg bg-[#A20202] px-4 py-2 text-sm font-semibold text-white hover:bg-[#870101]">
                + Tambah Metode
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full whitespace-nowrap">
                <thead>
                    <tr class="border-y border-gray-200 bg-gray-50 text-left text-xs font-bold uppercase tracking-wide text-gray-500">
                        <th class="px-4 py-3">Nama Metode</th>
                        <th class="px-4 py-3">Kode</th>
                        <th class="px-4 py-3">Deskripsi</th>
                        <th class="px-4 py-3">Urutan</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                    @forelse ($paymentMethods as $paymentMethod)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 font-semibold text-gray-800">{{ $paymentMethod->name }}</td>
                            <td class="px-4 py-3 text-gray-500">{{ $paymentMethod->code }}</td>
                            <td class="px-4 py-3 text-gray-500">{{ $paymentMethod->description ?: '-' }}</td>
                            <td class="px-4 py-3">{{ $paymentMethod->sort_order }}</td>
                            <td class="px-4 py-3">
                                @if ($paymentMethod->is_active)
                                    <span class="rounded-md bg-green-50 px-2 py-1 text-xs font-semibold text-green-700">Aktif</span>
                                @else
                                    <span class="rounded-md bg-gray-100 px-2 py-1 text-xs font-semibold text-gray-700">Nonaktif</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.payment-methods.edit', $paymentMethod) }}" class="rounded-md border border-gray-300 px-3 py-1.5 text-xs font-semibold text-gray-700 hover:bg-gray-50">Edit</a>
                                    <form action="{{ route('admin.payment-methods.destroy', $paymentMethod) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus metode pembayaran ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="rounded-md border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-700 hover:bg-red-100">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-sm text-gray-500">Belum ada metode pembayaran.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $paymentMethods->links() }}
        </div>
    </div>
</x-admin-layout>
