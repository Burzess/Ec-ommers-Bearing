<x-app-layout>
    <div class="py-3 sm:py-6">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <h1 class="mb-4 text-2xl font-bold uppercase underline decoration-2 underline-offset-4 md:mb-6 md:text-3xl">
                profil akun pengguna
            </h1>

            <div class="grid gap-0 lg:grid-cols-[360px_1fr]">
                <aside class="px-6 py-8 text-black sm:px-8">
                    <div class="mt-6 rounded-[2rem] bg-[#5470b0] px-6 py-8 shadow-inner ring-1 ring-white/10">
                        <div class="flex flex-col items-center text-center">
                            <div
                                class="flex h-28 w-28 items-center justify-center overflow-hidden rounded-[1.75rem] bg-[#435b92] shadow-lg ring-4 ring-white/10">
                                @if ($user && $user->avatar ?? false)
                                    <img src="{{ $user->avatar }}" alt="Avatar {{ $user->name }}"
                                        class="h-full w-full object-cover">
                                @else
                                    <div
                                        class="flex h-full w-full items-center justify-center bg-[#435b92] text-4xl font-black text-white">
                                        {{ $initials ?: 'U' }}
                                    </div>
                                @endif
                            </div>

                            <div class="mt-5 text-[2rem] font-extrabold leading-none tracking-tight text-white">
                                {{ $user->name ?? 'Pengguna' }}
                            </div>

                            <p class="mt-2 text-lg font-semibold leading-none text-white/90">
                                {{ $user->username ?? $user->email ?? '' }}
                            </p>
                        </div>

                        <div class="my-8 h-px w-full bg-white/20"></div>

                        <div class="w-full space-y-2 text-left text-base font-bold">
                            <a href="#profile-akun"
                                class="group flex items-center justify-between rounded-xl bg-white/0 px-3 py-2 text-white transition hover:bg-white/10">
                                <span>Profil Akun</span>
                                <span class="text-white/60 transition group-hover:text-white">›</span>
                            </a>
                            <a href="#atur-alamat"
                                class="group flex items-center justify-between rounded-xl bg-white/0 px-3 py-2 text-white transition hover:bg-white/10">
                                <span>Atur Alamat</span>
                                <span class="text-white/60 transition group-hover:text-white">›</span>
                            </a>
                            <a href="#riwayat-pembelian"
                                class="group flex items-center justify-between rounded-xl bg-white/0 px-3 py-2 text-white transition hover:bg-white/10">
                                <span>Riwayat Pembelian</span>
                                <span class="text-white/60 transition group-hover:text-white">›</span>
                            </a>
                            <a href="#ubah-password"
                                class="group flex items-center justify-between rounded-xl bg-white/0 px-3 py-2 text-white transition hover:bg-white/10">
                                <span>Ubah Password</span>
                                <span class="text-white/60 transition group-hover:text-white">›</span>
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="pt-1">
                                @csrf
                                <button type="submit"
                                    class="group flex w-full items-center justify-between rounded-xl px-3 py-2 text-left text-white transition hover:bg-white/10">
                                    <span>Keluar</span>
                                    <span class="text-white/60 transition group-hover:text-white">›</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </aside>

                <main class="lg:border-l-8 lg:border-black">
                    <div class="space-y-0">
                        <section id="profile-akun" class="border-b border-black bg-white px-6 py-8 sm:px-8">
                            <div class="mb-4 flex items-center justify-between gap-4">
                                <div>
                                    <h2 class="text-2xl font-extrabold uppercase text-black">
                                        Profil Akun
                                    </h2>
                                    <p class="mt-1 text-sm font-medium text-gray-600">
                                        Informasi akun dan identitas pengguna.
                                    </p>
                                </div>
                            </div>

                            <div class="grid gap-4 md:grid-cols-2">
                                <div>
                                    <label class="mb-2 block text-sm font-extrabold uppercase text-black">Nama
                                        Pelanggan</label>
                                    <div class="bg-[#dddddd] px-4 py-3 text-lg font-bold text-[#6a6a6a]">
                                        {{ $user->name ?? '-' }}
                                    </div>
                                </div>

                                <div>
                                    <label
                                        class="mb-2 block text-sm font-extrabold uppercase text-black">Username</label>
                                    <div class="bg-[#dddddd] px-4 py-3 text-lg font-bold text-[#6a6a6a]">
                                        {{ $user->username ?? '-' }}
                                    </div>
                                </div>

                                <div>
                                    <label class="mb-2 block text-sm font-extrabold uppercase text-black">Nomor
                                        Telepon</label>
                                    <div class="bg-[#dddddd] px-4 py-3 text-lg font-bold text-[#6a6a6a]">
                                        {{ $user->phone ?? '+' }}
                                    </div>
                                </div>

                                <div>
                                    <label class="mb-2 block text-sm font-extrabold uppercase text-black">Email</label>
                                    <div class="bg-[#dddddd] px-4 py-3 text-lg font-bold text-[#6a6a6a]">
                                        {{ $user->email ?? '-' }}
                                    </div>
                                </div>
                            </div>

                            <div class="mt-8 rounded-2xl border border-black/10 bg-[#f7f7f7] p-5">
                                @include('profile.partials.update-profile-information-form')
                            </div>
                        </section>

                        <section id="atur-alamat" class="border-b border-black bg-white px-6 py-8 sm:px-8">
                            <h2 class="text-2xl font-extrabold uppercase text-black">Atur Alamat</h2>
                            <p class="mt-2 max-w-2xl text-sm font-medium text-gray-600">
                                Kelola alamat pengiriman Anda untuk memudahkan proses checkout di masa mendatang.
                            </p>

                            <form method="POST" action="{{ route('profile.address.update') }}"
                                class="mt-6 rounded-2xl border border-black/10 bg-[#f7f7f7] p-5 sm:p-6">
                                @csrf
                                @method('PATCH')

                                <div class="space-y-4">
                                    <div>
                                        <label for="address"
                                            class="mb-2 block text-sm font-extrabold uppercase text-black">Alamat
                                            Lengkap</label>
                                        <textarea id="address" name="address" rows="4"
                                            class="block w-full rounded-lg border-0 px-4 py-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 outline-none transition-all duration-200 focus:ring-2 focus:ring-inset focus:ring-[#500000] sm:text-sm sm:leading-6"
                                            placeholder="Masukkan alamat lengkap Anda...">{{ old('address', $user->address ?? '') }}</textarea>
                                        @error('address')
                                            <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="grid gap-4 md:grid-cols-2">
                                        <div>
                                            <label for="shipping_city_id"
                                                class="mb-2 block text-sm font-extrabold uppercase text-black">Kota</label>
                                            <select id="shipping_city_id" name="shipping_city_id"
                                                class="block w-full rounded-lg border-0 py-2.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#500000] sm:text-sm sm:leading-6 transition-all duration-200"
                                                required>
                                                <option value="">Pilih kota tujuan</option>
                                                @foreach ($shippingCities as $shippingCity)
                                                    <option value="{{ $shippingCity->id }}"
                                                        @selected((string) old('shipping_city_id', $user->shipping_city_id) === (string) $shippingCity->id)>
                                                        {{ $shippingCity->name }} - Rp
                                                        {{ number_format((float) $shippingCity->shipping_cost, 0, '.', '.') }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('shipping_city_id')
                                                <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="postal_code"
                                                class="mb-2 block text-sm font-extrabold uppercase text-black">Kode
                                                Pos</label>
                                            <input id="postal_code" name="postal_code" type="text"
                                                class="block w-full rounded-lg border-0 py-2.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#500000] sm:text-sm sm:leading-6 transition-all duration-200"
                                                placeholder="Contoh: 10110"
                                                value="{{ old('postal_code', $user->postal_code ?? '') }}">
                                            @error('postal_code')
                                                <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div>
                                        <label for="phone_address"
                                            class="mb-2 block text-sm font-extrabold uppercase text-black">Nomor
                                            Telepon</label>
                                        <input id="phone_address" name="phone" type="text"
                                            class="block w-full rounded-lg border-0 py-2.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#500000] sm:text-sm sm:leading-6 transition-all duration-200"
                                            placeholder="Contoh: 081234567890"
                                            value="{{ old('phone', $user->phone ?? '') }}">
                                        @error('phone')
                                            <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
                                        @enderror
                                        </div>
                                    </div>

                                <div class="mt-6 flex flex-wrap items-center gap-3">
                                    <button type="submit"
                                        class="inline-flex items-center justify-center rounded-lg bg-[#500000] px-8 py-3 text-sm font-bold uppercase tracking-wide text-white transition hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-[#500000] focus:ring-offset-2">
                                        Simpan Alamat
                                    </button>

                                    @if (session('status') === 'address-updated')
                                        <p class="text-sm font-medium text-gray-600">Alamat berhasil disimpan.</p>
                                    @endif
                                </div>
                            </form>
                        </section>

                        <section id="riwayat-pembelian" class="border-b border-black bg-white px-6 py-8 sm:px-8">
                            <h2 class="text-2xl font-extrabold uppercase text-black">Riwayat Pembelian</h2>
                            <p class="mt-2 max-w-2xl text-sm font-medium text-gray-600">
                                Daftar pesanan yang pernah dibuat oleh pengguna. Klik pada setiap pesanan untuk melihat
                                detailnya.
                            </p>

                            <div class="mt-6 space-y-4">
                                @forelse ($orders as $order)
                                    @php
                                        $statusLabels = [
                                            'pending' => 'Menunggu Pembayaran',
                                            'paid' => 'Sudah Dibayar',
                                            'shipped' => 'Dikirim',
                                            'completed' => 'Selesai',
                                            'cancelled' => 'Dibatalkan',
                                        ];
                                    @endphp

                                    <article x-data="{ open: false }"
                                        class="rounded-2xl border border-gray-300 bg-[#f7f7f7] p-5">
                                        <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
                                            <div>
                                                <p class="text-sm font-semibold text-gray-500">
                                                    {{ $order->created_at->translatedFormat('d M Y') }}
                                                </p>
                                                <h3 class="mt-1 text-lg font-extrabold text-black">
                                                    {{ $order->invoice_number }}
                                                </h3>
                                                <p class="mt-1 text-sm font-semibold text-gray-700">Total:
                                                    Rp {{ number_format((float) $order->total_price, 0, '.', '.') }}
                                                </p>
                                            </div>

                                            <div class="flex items-center gap-3">
                                                <span
                                                    class="inline-flex rounded-full bg-[#500000]/10 px-3 py-1 text-xs font-bold uppercase tracking-wide text-[#500000]">
                                                    {{ $statusLabels[$order->status] ?? strtoupper($order->status) }}
                                                </span>
                                                <button type="button" @click="open = !open"
                                                    class="inline-flex items-center justify-center rounded-lg bg-[#500000] px-4 py-2 text-xs font-bold uppercase tracking-wide text-white transition hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-[#500000] focus:ring-offset-2">
                                                    <span x-show="!open">Lihat Detail</span>
                                                    <span x-show="open" style="display: none;">Sembunyikan</span>
                                                </button>
                                            </div>
                                        </div>

                                        <div x-show="open" x-transition class="mt-4 border-t border-gray-300 pt-4"
                                            style="display: none;">
                                            <h4 class="text-sm font-extrabold uppercase text-black">Item Pesanan</h4>
                                            <ul class="mt-3 space-y-2">
                                                @forelse ($order->items as $item)
                                                    <li class="flex items-center justify-between rounded-lg bg-white px-4 py-3 text-sm ring-1 ring-gray-200">
                                                        <span class="font-semibold text-gray-800">{{ $item->product?->name ?? 'Produk tidak ditemukan' }}</span>
                                                        <span class="text-gray-600">{{ $item->quantity }} x Rp {{ number_format((float) $item->price, 0, '.', '.') }}</span>
                                                    </li>
                                                @empty
                                                    <li class="rounded-lg bg-white px-4 py-3 text-sm text-gray-500 ring-1 ring-gray-200">
                                                        Item pesanan tidak tersedia.
                                                    </li>
                                                @endforelse
                                            </ul>
                                        </div>
                                    </article>
                                @empty
                                    <div class="rounded-2xl border border-gray-200 bg-[#f7f7f7] p-5 text-sm font-medium text-gray-600">
                                        Anda belum memiliki riwayat pembelian.
                                    </div>
                                @endforelse

                                @if ($totalOrdersCount > $orders->count())
                                    <div class="flex flex-col items-start gap-2 pt-2">
                                        <p class="text-sm font-medium text-gray-600">
                                            Menampilkan {{ $orders->count() }} dari {{ $totalOrdersCount }} pesanan.
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </section>

                        <section id="ubah-password" class="border-b border-black bg-white px-6 py-8 sm:px-8">
                            <div class="rounded-2xl border border-black/10 bg-[#f7f7f7] p-5">
                                @include('profile.partials.update-password-form')
                            </div>
                        </section>

                        <section class="bg-white px-6 py-8 sm:px-8">
                            <div class="rounded-2xl border border-red-200 bg-red-50 p-5">
                                @include('profile.partials.delete-user-form')
                            </div>
                        </section>
                    </div>
                </main>
            </div>
        </div>
    </div>
</x-app-layout>