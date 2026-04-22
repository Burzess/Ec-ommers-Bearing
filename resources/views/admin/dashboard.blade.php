<x-admin-layout>
    <x-slot name="header">
        Dashboard & Analitik Utama
    </x-slot>

    <div class="mb-8 grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm">
            <div class="mb-3 inline-flex rounded-lg bg-red-50 p-2 text-[#A20202]">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0" /></svg>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-500">Pendapatan Terealisasi</p>
                <p class="mt-1 text-xl font-bold text-gray-900">Rp{{ number_format($totalRevenue, 0, ',', '.') }}</p>
                <p class="mt-1 text-[11px] text-gray-400">Total dana dari pesanan yang sudah dibayar atau selesai.</p>
            </div>
        </div>

        <div class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm">
            <div class="mb-3 inline-flex rounded-lg bg-blue-50 p-2 text-blue-600">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-500">Total Pesanan</p>
                <p class="mt-1 text-2xl font-bold text-gray-900">{{ number_format($totalOrders) }}</p>
                <p class="mt-1 text-[11px] text-gray-400">Jumlah seluruh pesanan yang masuk ke sistem.</p>
            </div>
        </div>

        <div class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm">
            <div class="mb-3 inline-flex rounded-lg bg-emerald-50 p-2 text-emerald-600">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-500">Trafik Unik (30 Hari)</p>
                <p class="mt-1 text-2xl font-bold text-gray-900">{{ number_format($uniqueTraffic) }}</p>
                <p class="mt-1 text-[11px] text-gray-400">Jumlah pelanggan unik yang aktif dalam 30 hari terakhir.</p>
            </div>
        </div>

        <div class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm">
            <div class="mb-3 inline-flex rounded-lg bg-amber-50 p-2 text-amber-600">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0" /></svg>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-500">Conversion Rate</p>
                <p class="mt-1 text-2xl font-bold text-gray-900">{{ number_format($conversionRate, 2, ',', '.') }}%</p>
                <p class="mt-1 text-[11px] text-gray-400">Persentase pengunjung yang menjadi pembeli.</p>
            </div>
        </div>
    </div>

    <div class="mb-8 grid grid-cols-1 gap-6 xl:grid-cols-3">
        <section
            x-data="{
                chart: @js($revenueChart),
                activePeriod: 'daily',
                get current() { return this.chart[this.activePeriod] },
                get maxValue() { return Math.max(...this.current.values, 1) },
                barHeight(value) { return Math.max((value / this.maxValue) * 100, 8) },
                formatCurrency(value) { return new Intl.NumberFormat('id-ID').format(value) }
            }"
            class="xl:col-span-2 rounded-xl border border-gray-100 bg-white p-5 shadow-sm"
        >
            <div class="mb-5 flex flex-wrap items-center justify-between gap-3">
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Ringkasan Penjualan</h3>
                    <p class="text-sm text-gray-500">Grafik pendapatan harian, mingguan, dan bulanan.</p>
                    <p class="mt-0.5 text-[10px] text-gray-400 italic" x-show="activePeriod === 'weekly'">*Keterangan: 'Mgg' merujuk pada urutan minggu dalam kalender tahun ini.</p>
                </div>
                <div class="inline-flex rounded-lg border border-gray-200 p-1">
                    <button
                        type="button"
                        @click="activePeriod = 'daily'"
                        :class="activePeriod === 'daily' ? 'bg-[#A20202] text-white' : 'text-gray-600 hover:bg-gray-100'"
                        class="rounded-md px-3 py-1.5 text-xs font-semibold"
                    >
                        Harian
                    </button>
                    <button
                        type="button"
                        @click="activePeriod = 'weekly'"
                        :class="activePeriod === 'weekly' ? 'bg-[#A20202] text-white' : 'text-gray-600 hover:bg-gray-100'"
                        class="rounded-md px-3 py-1.5 text-xs font-semibold"
                    >
                        Mingguan
                    </button>
                    <button
                        type="button"
                        @click="activePeriod = 'monthly'"
                        :class="activePeriod === 'monthly' ? 'bg-[#A20202] text-white' : 'text-gray-600 hover:bg-gray-100'"
                        class="rounded-md px-3 py-1.5 text-xs font-semibold"
                    >
                        Bulanan
                    </button>
                </div>
            </div>

            <div class="flex h-64 items-end gap-2 px-2 sm:gap-4">
                <template x-for="(value, index) in current.values" :key="index">
                    <div class="flex flex-1 flex-col items-center justify-end gap-2 h-full">
                        <p class="text-[10px] font-bold text-gray-400" x-text="'Rp' + formatCurrency(value)"></p>
                        <div 
                            class="w-full rounded-t-lg bg-[#A20202] transition-all duration-500 hover:bg-[#7f0000]" 
                            :style="`height: ${barHeight(value)}%`"
                            :title="'Rp' + formatCurrency(value)"
                        ></div>
                        <p class="text-[11px] font-medium text-gray-500" x-text="current.labels[index]"></p>
                    </div>
                </template>
            </div>
        </section>

        <section class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm">
            <h3 class="text-lg font-bold text-gray-900">Status Pesanan</h3>
            <p class="mb-4 text-sm text-gray-500">Monitoring tahapan pesanan saat ini.</p>

            <div class="space-y-3">
                @foreach ($orderStatusSummary as $summary)
                    @php
                        $badgeClasses = [
                            'pending' => 'bg-yellow-50 text-yellow-700',
                            'paid' => 'bg-blue-50 text-blue-700',
                            'shipped' => 'bg-indigo-50 text-indigo-700',
                            'completed' => 'bg-green-50 text-green-700',
                        ][$summary['status']] ?? 'bg-gray-50 text-gray-700';
                    @endphp

                    <div class="flex items-center justify-between rounded-lg border border-gray-100 px-4 py-3">
                        <p class="text-sm font-semibold text-gray-700">{{ $summary['label'] }}</p>
                        <span class="rounded-md px-2.5 py-1 text-sm font-bold {{ $badgeClasses }}">
                            {{ number_format($summary['count']) }}
                        </span>
                    </div>
                @endforeach
            </div>
        </section>
    </div>

    <div class="mb-8 grid grid-cols-1 gap-6 lg:grid-cols-3">
        <section class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm lg:col-span-1">
            <h3 class="text-lg font-bold text-gray-900">Metrik Pengunjung</h3>
            <p class="mb-4 text-sm text-gray-500">Ringkasan trafik unik dan conversion rate 30 hari terakhir.</p>

            <div class="space-y-3">
                <div class="rounded-lg bg-gray-50 px-4 py-3">
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Trafik Unik</p>
                    <p class="mt-1 text-2xl font-bold text-gray-900">{{ number_format($uniqueTraffic) }}</p>
                </div>
                <div class="rounded-lg bg-gray-50 px-4 py-3">
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Conversion Rate</p>
                    <p class="mt-1 text-2xl font-bold text-gray-900">{{ number_format($conversionRate, 2, ',', '.') }}%</p>
                </div>
                <div class="rounded-lg bg-gray-50 px-4 py-3">
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Total Produk</p>
                    <p class="mt-1 text-2xl font-bold text-gray-900">{{ number_format($totalProducts) }}</p>
                </div>
                <div class="rounded-lg bg-gray-50 px-4 py-3">
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Total Pelanggan</p>
                    <p class="mt-1 text-2xl font-bold text-gray-900">{{ number_format($totalUsers) }}</p>
                </div>
            </div>
        </section>

        <section class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm lg:col-span-2">
            <div class="mb-4 flex items-start justify-between gap-3">
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Notifikasi Stok</h3>
                    <p class="text-sm text-gray-500">Peringatan otomatis untuk stok produk kurang dari atau sama dengan {{ $lowStockThreshold }}.</p>
                </div>
                <span class="rounded-lg bg-red-50 px-3 py-1 text-xs font-bold text-[#A20202]">
                    {{ $lowStockProducts->count() }} produk perlu perhatian
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="js-admin-datatable min-w-full whitespace-nowrap" data-page-length="8">
                    <thead>
                        <tr class="border-y border-gray-200 bg-gray-50 text-left text-xs font-bold uppercase tracking-wide text-gray-500">
                            <th class="px-4 py-3">Produk</th>
                            <th class="px-4 py-3">Kategori</th>
                            <th class="px-4 py-3">Stok</th>
                            <th class="px-4 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                        @forelse ($lowStockProducts as $product)
                            <tr>
                                <td class="px-4 py-3 font-semibold text-gray-900">{{ $product->name }}</td>
                                <td class="px-4 py-3">{{ $product->category?->name ?? '-' }}</td>
                                <td class="px-4 py-3">
                                    <span class="rounded-md px-2.5 py-1 text-xs font-bold {{ $product->stock <= 0 ? 'bg-red-100 text-red-700' : 'bg-amber-100 text-amber-700' }}">
                                        {{ $product->stock }} unit
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="rounded-md border border-gray-300 px-3 py-1.5 text-xs font-semibold text-gray-700 hover:bg-gray-50">Perbarui Stok</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-8 text-center text-sm text-gray-500">
                                    Tidak ada produk dengan stok kritis. Stok aman.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    <div class="w-full overflow-hidden rounded-xl border border-gray-100 bg-white shadow-sm">
        <div class="flex flex-col border-b border-gray-100 px-6 py-5">
            <h3 class="text-lg font-bold text-gray-900">Transaksi Terkini</h3>
            <p class="text-xs text-gray-500">Daftar 5 pesanan terbaru yang masuk ke sistem.</p>
        </div>
        <div class="w-full overflow-x-auto">
            <table class="js-admin-datatable w-full whitespace-nowrap" data-page-length="5">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50/50 text-left text-xs font-bold uppercase tracking-wide text-gray-400">
                        <th class="px-6 py-4">Nomor Invoice</th>
                        <th class="px-6 py-4">Nama Pelanggan</th>
                        <th class="px-6 py-4">Total Tagihan</th>
                        <th class="px-6 py-4">Status Pesanan</th>
                        <th class="px-6 py-4">Waktu Transaksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse ($recentOrders as $order)
                        <tr class="text-gray-600 transition-colors hover:bg-gray-50/50">
                            <td class="px-6 py-4 text-sm font-bold text-gray-800">
                                <a href="{{ route('admin.orders.show', $order) }}" class="hover:text-[#A20202] hover:underline">
                                    #{{ $order->invoice_number }}
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center text-sm">
                                    <div class="mr-3 flex h-8 w-8 items-center justify-center rounded-full bg-indigo-100 font-bold text-indigo-500">
                                        {{ substr($order->user->name ?? 'T', 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-800">{{ $order->user->name ?? 'Tamu' }}</p>
                                        <p class="text-xs text-gray-500">{{ $order->user->email ?? '-' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm font-semibold text-gray-800">
                                Rp{{ number_format($order->total_price, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-xs font-bold">
                                @php
                                    $statusClasses = [
                                        'pending' => 'bg-yellow-50 text-yellow-600 ring-1 ring-yellow-500/20',
                                        'paid' => 'bg-blue-50 text-blue-600 ring-1 ring-blue-500/20',
                                        'shipped' => 'bg-indigo-50 text-indigo-600 ring-1 ring-indigo-500/20',
                                        'completed' => 'bg-green-50 text-green-600 ring-1 ring-green-500/20',
                                        'cancelled' => 'bg-red-50 text-red-600 ring-1 ring-red-500/20',
                                    ];
                                    $statusClass = $statusClasses[$order->status] ?? 'bg-gray-50 text-gray-600 ring-1 ring-gray-500/20';
                                @endphp
                                <span class="inline-flex items-center gap-1.5 rounded-md px-2.5 py-1.5 leading-tight {{ $statusClass }}">
                                    <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                    {{ strtoupper($order->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-500">
                                {{ $order->created_at->translatedFormat('d M Y, H:i') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="mb-3 h-10 w-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" /></svg>
                                    <p class="font-medium text-gray-400">Belum ada pesanan masuk bulan ini.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>