@csrf

<div class="grid grid-cols-1 gap-5 md:grid-cols-2">
    <div>
        <label for="name" class="mb-1 block text-sm font-semibold text-gray-700">Nama Metode</label>
        <input id="name" name="name" type="text" value="{{ old('name', $paymentMethod->name ?? '') }}" required class="w-full rounded-lg border-gray-300 text-sm focus:border-[#A20202] focus:ring-[#A20202]">
        @error('name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="code" class="mb-1 block text-sm font-semibold text-gray-700">Kode</label>
        <input id="code" name="code" type="text" value="{{ old('code', $paymentMethod->code ?? '') }}" required class="w-full rounded-lg border-gray-300 text-sm focus:border-[#A20202] focus:ring-[#A20202]">
        @error('code')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div class="md:col-span-2">
        <label for="description" class="mb-1 block text-sm font-semibold text-gray-700">Deskripsi</label>
        <input id="description" name="description" type="text" value="{{ old('description', $paymentMethod->description ?? '') }}" class="w-full rounded-lg border-gray-300 text-sm focus:border-[#A20202] focus:ring-[#A20202]">
        @error('description')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="sort_order" class="mb-1 block text-sm font-semibold text-gray-700">Urutan Tampil</label>
        <input id="sort_order" name="sort_order" type="number" min="0" value="{{ old('sort_order', $paymentMethod->sort_order ?? 0) }}" class="w-full rounded-lg border-gray-300 text-sm focus:border-[#A20202] focus:ring-[#A20202]">
        @error('sort_order')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div class="flex items-center gap-3 pt-7">
        <input id="is_active" name="is_active" type="checkbox" value="1" class="h-4 w-4 rounded border-gray-300 text-[#A20202] focus:ring-[#A20202]"
            @checked((bool) old('is_active', $paymentMethod->is_active ?? true))>
        <label for="is_active" class="text-sm font-semibold text-gray-700">Aktifkan metode pembayaran ini</label>
    </div>
</div>

<div class="mt-6 flex items-center justify-end gap-3 border-t border-gray-100 pt-4">
    <a href="{{ route('admin.payment-methods.index') }}" class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">Batal</a>
    <button type="submit" class="rounded-lg bg-[#A20202] px-4 py-2 text-sm font-semibold text-white hover:bg-[#870101]">Simpan</button>
</div>
