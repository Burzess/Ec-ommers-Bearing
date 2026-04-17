<x-admin-layout>
    <x-slot name="header">
        Profil Admin
    </x-slot>

    @if (session('status') === 'profile-updated')
        <div class="mb-4 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-700">
            Profil berhasil diperbarui.
        </div>
    @endif

    @if (session('status') === 'password-updated')
        <div class="mb-4 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-700">
            Password berhasil diperbarui.
        </div>
    @endif

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm sm:p-6">
            <h3 class="mb-4 text-lg font-bold text-gray-800">Informasi Akun</h3>

            <form method="post" action="{{ route('admin.profile.update') }}" class="space-y-4">
                @csrf
                @method('patch')

                <div>
                    <label for="name" class="mb-1 block text-sm font-semibold text-gray-700">Nama Lengkap</label>
                    <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required class="w-full rounded-lg border-gray-300 text-sm focus:border-[#A20202] focus:ring-[#A20202]">
                    @error('name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="username" class="mb-1 block text-sm font-semibold text-gray-700">Username</label>
                    <input id="username" name="username" type="text" value="{{ old('username', $user->username) }}" class="w-full rounded-lg border-gray-300 text-sm focus:border-[#A20202] focus:ring-[#A20202]">
                    @error('username')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="email" class="mb-1 block text-sm font-semibold text-gray-700">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required class="w-full rounded-lg border-gray-300 text-sm focus:border-[#A20202] focus:ring-[#A20202]">
                    @error('email')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="phone" class="mb-1 block text-sm font-semibold text-gray-700">No. Telepon</label>
                    <input id="phone" name="phone" type="text" value="{{ old('phone', $user->phone) }}" class="w-full rounded-lg border-gray-300 text-sm focus:border-[#A20202] focus:ring-[#A20202]">
                    @error('phone')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="address" class="mb-1 block text-sm font-semibold text-gray-700">Alamat</label>
                    <textarea id="address" name="address" rows="4" class="w-full rounded-lg border-gray-300 text-sm focus:border-[#A20202] focus:ring-[#A20202]">{{ old('address', $user->address) }}</textarea>
                    @error('address')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div class="pt-2">
                    <button type="submit" class="rounded-lg bg-[#A20202] px-4 py-2 text-sm font-semibold text-white hover:bg-[#870101]">Simpan Perubahan</button>
                </div>
            </form>
        </div>

        <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm sm:p-6">
            <h3 class="mb-4 text-lg font-bold text-gray-800">Ubah Password</h3>

            <form method="post" action="{{ route('password.update') }}" class="space-y-4">
                @csrf
                @method('put')

                <div>
                    <label for="update_password_current_password" class="mb-1 block text-sm font-semibold text-gray-700">Password Saat Ini</label>
                    <input id="update_password_current_password" name="current_password" type="password" class="w-full rounded-lg border-gray-300 text-sm focus:border-[#A20202] focus:ring-[#A20202]">
                    @error('current_password', 'updatePassword')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="update_password_password" class="mb-1 block text-sm font-semibold text-gray-700">Password Baru</label>
                    <input id="update_password_password" name="password" type="password" class="w-full rounded-lg border-gray-300 text-sm focus:border-[#A20202] focus:ring-[#A20202]">
                    @error('password', 'updatePassword')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="update_password_password_confirmation" class="mb-1 block text-sm font-semibold text-gray-700">Konfirmasi Password Baru</label>
                    <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="w-full rounded-lg border-gray-300 text-sm focus:border-[#A20202] focus:ring-[#A20202]">
                </div>

                <div class="pt-2">
                    <button type="submit" class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">Perbarui Password</button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
