<x-admin-layout>
    <x-slot name="header">
        Tambah Produk
    </x-slot>

    <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm sm:p-6">
        <h3 class="mb-4 text-lg font-bold text-gray-800">Form Produk Baru</h3>

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @include('admin.products._form')
        </form>
    </div>
</x-admin-layout>
