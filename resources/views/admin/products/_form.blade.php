@csrf

<div class="grid grid-cols-1 gap-5 md:grid-cols-2">
    <div class="md:col-span-2">
        <label for="name" class="mb-1 block text-sm font-semibold text-gray-700">Nama Produk</label>
        <input id="name" name="name" type="text" value="{{ old('name', $product->name ?? '') }}" required class="w-full rounded-lg border-gray-300 text-sm focus:border-[#A20202] focus:ring-[#A20202]">
        @error('name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="sku" class="mb-1 block text-sm font-semibold text-gray-700">SKU</label>
        <input id="sku" name="sku" type="text" value="{{ old('sku', $product->sku ?? '') }}" required class="w-full rounded-lg border-gray-300 text-sm focus:border-[#A20202] focus:ring-[#A20202]">
        @error('sku')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="category_id" class="mb-1 block text-sm font-semibold text-gray-700">Kategori</label>
        <select id="category_id" name="category_id" class="w-full rounded-lg border-gray-300 text-sm focus:border-[#A20202] focus:ring-[#A20202]">
            <option value="">- Pilih Kategori -</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id ?? null) == $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="price" class="mb-1 block text-sm font-semibold text-gray-700">Harga</label>
        <input id="price" name="price" type="number" step="0.01" value="{{ old('price', $product->price ?? '') }}" required class="w-full rounded-lg border-gray-300 text-sm focus:border-[#A20202] focus:ring-[#A20202]">
        @error('price')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="stock" class="mb-1 block text-sm font-semibold text-gray-700">Stok</label>
        <input id="stock" name="stock" type="number" min="0" value="{{ old('stock', $product->stock ?? 0) }}" required class="w-full rounded-lg border-gray-300 text-sm focus:border-[#A20202] focus:ring-[#A20202]">
        @error('stock')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="inner_diameter" class="mb-1 block text-sm font-semibold text-gray-700">Inner Diameter (mm)</label>
        <input id="inner_diameter" name="inner_diameter" type="number" step="0.01" value="{{ old('inner_diameter', $product->inner_diameter ?? '') }}" class="w-full rounded-lg border-gray-300 text-sm focus:border-[#A20202] focus:ring-[#A20202]">
        @error('inner_diameter')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="outer_diameter" class="mb-1 block text-sm font-semibold text-gray-700">Outer Diameter (mm)</label>
        <input id="outer_diameter" name="outer_diameter" type="number" step="0.01" value="{{ old('outer_diameter', $product->outer_diameter ?? '') }}" class="w-full rounded-lg border-gray-300 text-sm focus:border-[#A20202] focus:ring-[#A20202]">
        @error('outer_diameter')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="thickness" class="mb-1 block text-sm font-semibold text-gray-700">Thickness (mm)</label>
        <input id="thickness" name="thickness" type="number" step="0.01" value="{{ old('thickness', $product->thickness ?? '') }}" class="w-full rounded-lg border-gray-300 text-sm focus:border-[#A20202] focus:ring-[#A20202]">
        @error('thickness')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div class="md:col-span-2">
        <label for="description" class="mb-1 block text-sm font-semibold text-gray-700">Deskripsi</label>
        <textarea id="description" name="description" rows="4" class="w-full rounded-lg border-gray-300 text-sm focus:border-[#A20202] focus:ring-[#A20202]">{{ old('description', $product->description ?? '') }}</textarea>
        @error('description')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div class="md:col-span-2">
        <label for="image" class="mb-1 block text-sm font-semibold text-gray-700">Gambar Produk</label>
        <input id="image" name="image" type="file" accept="image/*" class="w-full rounded-lg border border-gray-300 bg-white p-2 text-sm file:mr-3 file:rounded-md file:border-0 file:bg-gray-100 file:px-3 file:py-2 file:text-sm file:font-semibold file:text-gray-700 hover:file:bg-gray-200">
        @error('image')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror

        @if (!empty($product?->image))
            <div class="mt-3 flex items-center gap-4">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-20 w-20 rounded-lg border border-gray-200 object-cover">
                <label class="inline-flex items-center gap-2 text-sm text-gray-700">
                    <input type="checkbox" name="remove_image" value="1" class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                    Hapus gambar saat simpan
                </label>
            </div>
        @endif
    </div>
</div>

<div class="mt-6 flex items-center justify-end gap-3 border-t border-gray-100 pt-4">
    <a href="{{ route('admin.products.index') }}" class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">Batal</a>
    <button type="submit" class="rounded-lg bg-[#A20202] px-4 py-2 text-sm font-semibold text-white hover:bg-[#870101]">Simpan</button>
</div>
