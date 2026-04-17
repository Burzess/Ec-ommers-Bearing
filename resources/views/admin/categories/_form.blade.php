@csrf

<div>
    <label for="name" class="mb-1 block text-sm font-semibold text-gray-700">Nama Kategori</label>
    <input
        id="name"
        name="name"
        type="text"
        value="{{ old('name', $category->name ?? '') }}"
        required
        class="w-full rounded-lg border-gray-300 text-sm focus:border-[#A20202] focus:ring-[#A20202]"
        placeholder="Contoh: Ball Bearings"
    >
    @error('name')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div class="mt-6 flex items-center justify-end gap-3 border-t border-gray-100 pt-4">
    <a href="{{ route('admin.categories.index') }}" class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">Batal</a>
    <button type="submit" class="rounded-lg bg-[#A20202] px-4 py-2 text-sm font-semibold text-white hover:bg-[#870101]">Simpan</button>
</div>
