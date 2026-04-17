<x-admin-layout>
    <x-slot name="header">
        Edit Produk
    </x-slot>

    <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm sm:p-6">
        <h3 class="mb-4 text-lg font-bold text-gray-800">Ubah Data Produk</h3>

        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @include('admin.products._form')
        </form>
    </div>
</x-admin-layout>
