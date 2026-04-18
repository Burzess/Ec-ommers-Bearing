<x-admin-layout>
    <x-slot name="header">
        Profil Perusahaan
    </x-slot>

    @if (session('success'))
        <div class="mb-4 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm sm:p-6">
        <h3 class="mb-4 text-lg font-bold text-gray-800">Pengaturan Informasi Perusahaan</h3>

        <form action="{{ route('admin.company-setting.update') }}" method="POST" class="space-y-5">
            @csrf
            @method('PATCH')

            <div>
                <label for="company_name" class="mb-1 block text-sm font-semibold text-gray-700">Nama Perusahaan</label>
                <input id="company_name" name="company_name" type="text" value="{{ old('company_name', $companySetting->company_name) }}" required class="w-full rounded-lg border-gray-300 text-sm focus:border-[#A20202] focus:ring-[#A20202]">
                @error('company_name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="company_address" class="mb-1 block text-sm font-semibold text-gray-700">Alamat Perusahaan</label>
                <textarea id="company_address" name="company_address" rows="4" required class="w-full rounded-lg border-gray-300 text-sm focus:border-[#A20202] focus:ring-[#A20202]">{{ old('company_address', $companySetting->company_address) }}</textarea>
                @error('company_address')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                <div>
                    <label for="company_phone" class="mb-1 block text-sm font-semibold text-gray-700">Nomor Telepon</label>
                    <input id="company_phone" name="company_phone" type="text" value="{{ old('company_phone', $companySetting->company_phone) }}" required class="w-full rounded-lg border-gray-300 text-sm focus:border-[#A20202] focus:ring-[#A20202]">
                    @error('company_phone')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="company_email" class="mb-1 block text-sm font-semibold text-gray-700">Email Perusahaan</label>
                    <input id="company_email" name="company_email" type="email" value="{{ old('company_email', $companySetting->company_email) }}" required class="w-full rounded-lg border-gray-300 text-sm focus:border-[#A20202] focus:ring-[#A20202]">
                    @error('company_email')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                <div>
                    <label for="business_days" class="mb-1 block text-sm font-semibold text-gray-700">Hari Operasional</label>
                    <input id="business_days" name="business_days" type="text" value="{{ old('business_days', $companySetting->business_days) }}" placeholder="Contoh: Senin - Jumat" class="w-full rounded-lg border-gray-300 text-sm focus:border-[#A20202] focus:ring-[#A20202]">
                    @error('business_days')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="business_hours" class="mb-1 block text-sm font-semibold text-gray-700">Jam Operasional</label>
                    <input id="business_hours" name="business_hours" type="text" value="{{ old('business_hours', $companySetting->business_hours) }}" placeholder="Contoh: 08.00 - 17.00" class="w-full rounded-lg border-gray-300 text-sm focus:border-[#A20202] focus:ring-[#A20202]">
                    @error('business_hours')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>

            <div>
                <label for="maps_embed_url" class="mb-1 block text-sm font-semibold text-gray-700">Google Maps Embed URL</label>
                <input id="maps_embed_url" name="maps_embed_url" type="url" value="{{ old('maps_embed_url', $companySetting->maps_embed_url) }}" placeholder="https://www.google.com/maps/embed?..." class="w-full rounded-lg border-gray-300 text-sm focus:border-[#A20202] focus:ring-[#A20202]">
                @error('maps_embed_url')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div class="flex items-center justify-end gap-3 border-t border-gray-100 pt-4">
                <button type="submit" class="rounded-lg bg-[#A20202] px-4 py-2 text-sm font-semibold text-white hover:bg-[#870101]">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</x-admin-layout>
