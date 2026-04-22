@csrf

<div class="grid grid-cols-1 gap-5 md:grid-cols-2">
    <div>
        <label for="name" class="mb-1 block text-sm font-semibold text-gray-700">Nama Metode</label>
        <input id="name" name="name" type="text" value="{{ old('name', $paymentMethod->name ?? '') }}" placeholder="Contoh: Transfer Bank BCA" required class="w-full rounded-lg border-gray-300 text-sm focus:border-[#A20202] focus:ring-[#A20202]">
        <p class="mt-1 text-xs italic text-gray-400">Nama yang akan tampil di halaman checkout pelanggan.</p>
        @error('name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="code" class="mb-1 block text-sm font-semibold text-gray-700">Kode</label>
        <input id="code" name="code" type="text" value="{{ old('code', $paymentMethod->code ?? '') }}" placeholder="Contoh: transfer_bca" required class="w-full rounded-lg border-gray-300 text-sm focus:border-[#A20202] focus:ring-[#A20202]">
        <p class="mt-1 text-xs italic text-gray-400">Kode unik sistem (Gunakan huruf, angka, atau underscore).</p>
        @error('code')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div class="md:col-span-2">
        <label for="description" class="mb-1 block text-sm font-semibold text-gray-700">Deskripsi</label>
        <input id="description" name="description" type="text" value="{{ old('description', $paymentMethod->description ?? '') }}" placeholder="Contoh: Transfer ke rekening BCA 12345678 a/n PT Asian..." class="w-full rounded-lg border-gray-300 text-sm focus:border-[#A20202] focus:ring-[#A20202]">
        <p class="mt-1 text-xs italic text-gray-400">Keterangan singkat atau instruksi pembayaran (Maks. 255 karakter).</p>
        @error('description')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="sort_order" class="mb-1 block text-sm font-semibold text-gray-700">Urutan Tampil</label>
        <input id="sort_order" name="sort_order" type="number" min="0" value="{{ old('sort_order', $paymentMethod->sort_order ?? $nextSortOrder ?? 0) }}" placeholder="0" class="w-full rounded-lg border-gray-300 text-sm focus:border-[#A20202] focus:ring-[#A20202]">
        <p class="mt-1 text-xs italic text-gray-400">Urutan tampil (Angka kecil akan tampil lebih dulu).</p>
        @error('sort_order')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div class="flex items-center gap-3 pt-7">
        <input id="is_active" name="is_active" type="checkbox" value="1" class="h-4 w-4 rounded border-gray-300 text-[#A20202] focus:ring-[#A20202]"
            @checked((bool) old('is_active', $paymentMethod->is_active ?? true))>
        <div>
            <label for="is_active" class="text-sm font-semibold text-gray-700">Aktifkan metode pembayaran ini</label>
            <p class="text-[10px] italic text-gray-400 leading-none">Aktifkan agar pelanggan bisa memilih metode ini.</p>
        </div>
    </div>
</div>

<div class="mt-6 flex items-center justify-end gap-3 border-t border-gray-100 pt-4">
    <a href="{{ route('admin.payment-methods.index') }}" class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">Batal</a>
    <button type="submit" class="rounded-lg bg-[#A20202] px-4 py-2 text-sm font-semibold text-white hover:bg-[#870101]">Simpan</button>
</div>
