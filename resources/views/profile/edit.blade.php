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

                            <form class="mt-6 rounded-2xl border border-black/10 bg-[#f7f7f7] p-5 sm:p-6"
                                onsubmit="event.preventDefault(); showToast('Alamat berhasil disimpan.');">
                                <div class="space-y-4">
                                    <div>
                                        <label for="alamat_lengkap"
                                            class="mb-2 block text-sm font-extrabold uppercase text-black">Alamat
                                            Lengkap</label>
                                        <textarea id="alamat_lengkap" name="alamat_lengkap" rows="4"
                                            class="block w-full rounded-lg border-0 px-4 py-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 outline-none transition-all duration-200 focus:ring-2 focus:ring-inset focus:ring-[#500000] sm:text-sm sm:leading-6"
                                            placeholder="Masukkan alamat lengkap Anda...">{{ old('alamat_lengkap', $user->address ?? '') }}</textarea>
                                    </div>

                                    <div class="grid gap-4 md:grid-cols-2">
                                        <div>
                                            <label for="kota"
                                                class="mb-2 block text-sm font-extrabold uppercase text-black">Kota</label>
                                            <input id="kota" name="kota" type="text"
                                                class="block w-full rounded-lg border-0 py-2.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#500000] sm:text-sm sm:leading-6 transition-all duration-200"
                                                placeholder="Contoh: Jakarta">
                                        </div>

                                        <div>
                                            <label for="kode_pos"
                                                class="mb-2 block text-sm font-extrabold uppercase text-black">Kode
                                                Pos</label>
                                            <input id="kode_pos" name="kode_pos" type="text"
                                                class="block w-full rounded-lg border-0 py-2.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#500000] sm:text-sm sm:leading-6 transition-all duration-200"
                                                placeholder="Contoh: 10110">
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-6">
                                    <button type="submit"
                                        class="inline-flex items-center justify-center rounded-lg bg-[#500000] px-8 py-3 text-sm font-bold uppercase tracking-wide text-white transition hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-[#500000] focus:ring-offset-2">
                                        Simpan
                                    </button>
                                </div>
                            </form>
                        </section>

                        <section id="riwayat-pembelian" class="border-b border-black bg-white px-6 py-8 sm:px-8">
                            <h2 class="text-2xl font-extrabold uppercase text-black">Riwayat Pembelian</h2>
                            <p class="mt-2 max-w-2xl text-sm font-medium text-gray-600">
                                Daftar pesanan yang pernah dibuat oleh pengguna. Klik pada setiap pesanan untuk melihat
                                detailnya.
                            </p>

                            @php
                                $dummyOrders = [
                                    [
                                        'invoice' => 'INV-2026-0417-001',
                                        'date' => '17 Apr 2026',
                                        'status' => 'Diproses',
                                        'total' => 'Rp 1.250.000',
                                        'items' => [
                                            ['name' => 'Bearing 6205 ZZ', 'qty' => 2, 'price' => 'Rp 250.000'],
                                            ['name' => 'Bearing 6302 2RS', 'qty' => 3, 'price' => 'Rp 250.000'],
                                        ],
                                    ],
                                    [
                                        'invoice' => 'INV-2026-0410-014',
                                        'date' => '10 Apr 2026',
                                        'status' => 'Dikirim',
                                        'total' => 'Rp 875.000',
                                        'items' => [
                                            ['name' => 'Bearing 6203 2RS', 'qty' => 5, 'price' => 'Rp 175.000'],
                                        ],
                                    ],
                                    [
                                        'invoice' => 'INV-2026-0329-022',
                                        'date' => '29 Mar 2026',
                                        'status' => 'Selesai',
                                        'total' => 'Rp 2.100.000',
                                        'items' => [
                                            ['name' => 'Bearing 6310 ZZ', 'qty' => 4, 'price' => 'Rp 525.000'],
                                        ],
                                    ],
                                    [
                                        'invoice' => 'INV-2026-0321-031',
                                        'date' => '21 Mar 2026',
                                        'status' => 'Selesai',
                                        'total' => 'Rp 640.000',
                                        'items' => [
                                            ['name' => 'Bearing 6201 ZZ', 'qty' => 4, 'price' => 'Rp 160.000'],
                                        ],
                                    ],
                                ];

                                $displayOrders = array_slice($dummyOrders, 0, 3);
                                $hasMoreOrders = count($dummyOrders) > 3;
                            @endphp

                            <div class="mt-6 space-y-4">
                                @foreach ($displayOrders as $order)
                                    <article x-data="{ open: false }"
                                        class="rounded-2xl border border-gray-300 bg-[#f7f7f7] p-5">
                                        <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
                                            <div>
                                                <p class="text-sm font-semibold text-gray-500">{{ $order['date'] }}</p>
                                                <h3 class="mt-1 text-lg font-extrabold text-black">{{ $order['invoice'] }}
                                                </h3>
                                                <p class="mt-1 text-sm font-semibold text-gray-700">Total:
                                                    {{ $order['total'] }}
                                                </p>
                                            </div>

                                            <div class="flex items-center gap-3">
                                                <span
                                                    class="inline-flex rounded-full bg-[#500000]/10 px-3 py-1 text-xs font-bold uppercase tracking-wide text-[#500000]">
                                                    {{ $order['status'] }}
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
                                                @foreach ($order['items'] as $item)
                                                    <li
                                                        class="flex items-center justify-between rounded-lg bg-white px-4 py-3 text-sm ring-1 ring-gray-200">
                                                        <span class="font-semibold text-gray-800">{{ $item['name'] }}</span>
                                                        <span class="text-gray-600">{{ $item['qty'] }} x
                                                            {{ $item['price'] }}</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </article>
                                @endforeach

                                @if ($hasMoreOrders)
                                    <div class="flex flex-col items-start gap-2 pt-2">
                                        <p class="text-sm font-medium text-gray-600">
                                            Menampilkan 3 dari {{ count($dummyOrders) }} pesanan.
                                        </p>
                                        <a href="/profile/riwayat-pembelian"
                                            data-intended-route="/profile/riwayat-pembelian"
                                            onclick="event.preventDefault();"
                                            class="inline-flex items-center justify-center rounded-lg bg-[#500000] px-6 py-3 text-sm font-bold uppercase tracking-wide text-white transition hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-[#500000] focus:ring-offset-2">
                                            Lihat Selengkapnya
                                        </a>
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