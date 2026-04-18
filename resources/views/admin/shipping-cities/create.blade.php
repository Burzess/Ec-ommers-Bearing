<x-admin-layout>
    <x-slot name="header">
        Tambah Kota Ongkir
    </x-slot>

    <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm sm:p-6">
        <h3 class="mb-4 text-lg font-bold text-gray-800">Form Kota Ongkir Baru</h3>

        <form action="{{ route('admin.shipping-cities.store') }}" method="POST">
            @include('admin.shipping-cities._form')
        </form>
    </div>
</x-admin-layout>
