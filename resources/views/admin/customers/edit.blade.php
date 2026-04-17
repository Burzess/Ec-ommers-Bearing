<x-admin-layout>
    <x-slot name="header">
        Edit Pelanggan
    </x-slot>

    <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm sm:p-6">
        <h3 class="mb-4 text-lg font-bold text-gray-800">Ubah Data Pelanggan</h3>

        <form action="{{ route('admin.customers.update', $customer) }}" method="POST" class="grid grid-cols-1 gap-5 md:grid-cols-2">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="mb-1 block text-sm font-semibold text-gray-700">Nama Lengkap</label>
                <input id="name" name="name" type="text" value="{{ old('name', $customer->name) }}" required class="w-full rounded-lg border-gray-300 text-sm focus:border-[#A20202] focus:ring-[#A20202]">
                @error('name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="username" class="mb-1 block text-sm font-semibold text-gray-700">Username</label>
                <input id="username" name="username" type="text" value="{{ old('username', $customer->username) }}" class="w-full rounded-lg border-gray-300 text-sm focus:border-[#A20202] focus:ring-[#A20202]">
                @error('username')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="email" class="mb-1 block text-sm font-semibold text-gray-700">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email', $customer->email) }}" required class="w-full rounded-lg border-gray-300 text-sm focus:border-[#A20202] focus:ring-[#A20202]">
                @error('email')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="phone" class="mb-1 block text-sm font-semibold text-gray-700">No. Telepon</label>
                <input id="phone" name="phone" type="text" value="{{ old('phone', $customer->phone) }}" class="w-full rounded-lg border-gray-300 text-sm focus:border-[#A20202] focus:ring-[#A20202]">
                @error('phone')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div class="md:col-span-2">
                <label for="address" class="mb-1 block text-sm font-semibold text-gray-700">Alamat</label>
                <textarea id="address" name="address" rows="4" class="w-full rounded-lg border-gray-300 text-sm focus:border-[#A20202] focus:ring-[#A20202]">{{ old('address', $customer->address) }}</textarea>
                @error('address')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div class="md:col-span-2 flex items-center justify-end gap-3 border-t border-gray-100 pt-4">
                <a href="{{ route('admin.customers.index') }}" class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">Batal</a>
                <button type="submit" class="rounded-lg bg-[#A20202] px-4 py-2 text-sm font-semibold text-white hover:bg-[#870101]">Simpan</button>
            </div>
        </form>
    </div>
</x-admin-layout>
