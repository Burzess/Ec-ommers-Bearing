<x-admin-layout>
    <x-slot name="header">
        Tambah Metode Pembayaran
    </x-slot>

    <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm sm:p-6">
        <h3 class="mb-4 text-lg font-bold text-gray-800">Form Metode Pembayaran Baru</h3>

        <form action="{{ route('admin.payment-methods.store') }}" method="POST">
            @include('admin.payment-methods._form')
        </form>
    </div>
</x-admin-layout>
