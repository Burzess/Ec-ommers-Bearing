<x-admin-layout>
    <x-slot name="header">
        Edit Metode Pembayaran
    </x-slot>

    <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm sm:p-6">
        <h3 class="mb-4 text-lg font-bold text-gray-800">Perbarui Metode Pembayaran</h3>

        <form action="{{ route('admin.payment-methods.update', $paymentMethod) }}" method="POST">
            @method('PUT')
            @include('admin.payment-methods._form')
        </form>
    </div>
</x-admin-layout>
