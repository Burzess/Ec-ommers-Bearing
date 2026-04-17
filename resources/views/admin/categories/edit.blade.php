<x-admin-layout>
    <x-slot name="header">
        Edit Kategori
    </x-slot>

    <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm sm:p-6">
        <h3 class="mb-4 text-lg font-bold text-gray-800">Ubah Data Kategori</h3>

        <form action="{{ route('admin.categories.update', $category) }}" method="POST">
            @method('PUT')
            @include('admin.categories._form')
        </form>
    </div>
</x-admin-layout>
