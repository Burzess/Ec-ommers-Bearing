@csrf

<div class="grid grid-cols-1 gap-5 md:grid-cols-2">
    <div class="md:col-span-2">
        <label for="name" class="mb-1 block text-sm font-semibold text-gray-700">Nama Kota / Kabupaten</label>
        <input id="name" name="name" type="text" value="{{ old('name', $shippingCity->name ?? '') }}" required class="w-full rounded-lg border-gray-300 text-sm focus:border-[#A20202] focus:ring-[#A20202]">
        @error('name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="shipping_cost" class="mb-1 block text-sm font-semibold text-gray-700">Biaya Ongkir</label>
        <input id="shipping_cost" name="shipping_cost" type="number" step="0.01" min="0" value="{{ old('shipping_cost', $shippingCity->shipping_cost ?? '') }}" required class="w-full rounded-lg border-gray-300 text-sm focus:border-[#A20202] focus:ring-[#A20202]">
        @error('shipping_cost')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div class="flex items-center gap-3 pt-7">
        <input id="is_active" name="is_active" type="checkbox" value="1" class="h-4 w-4 rounded border-gray-300 text-[#A20202] focus:ring-[#A20202]"
            @checked((bool) old('is_active', $shippingCity->is_active ?? true))>
        <label for="is_active" class="text-sm font-semibold text-gray-700">Aktifkan kota ini</label>
    </div>
</div>

<div class="mt-6 flex items-center justify-end gap-3 border-t border-gray-100 pt-4">
    <a href="{{ route('admin.shipping-cities.index') }}" class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">Batal</a>
    <button type="submit" class="rounded-lg bg-[#A20202] px-4 py-2 text-sm font-semibold text-white hover:bg-[#870101]">Simpan</button>
</div>
