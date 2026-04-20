<x-owner-layout>
    <x-slot name="header">
        Pantauan Tren Pendapatan
    </x-slot>

    <section class="mb-6 rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
        <h3 class="text-lg font-bold text-gray-900">Ringkasan Naik atau Turun</h3>
        <p class="mt-1 text-sm text-gray-500">
            Data pendapatan dihitung dari pesanan dengan status <span class="font-semibold">PAID</span>, <span class="font-semibold">SHIPPED</span>, dan <span class="font-semibold">COMPLETED</span>.
        </p>
    </section>

    <div class="grid grid-cols-1 gap-5 lg:grid-cols-3">
        @foreach ($ringkasanTrenPendapatan as $tren)
            @php
                $kelasArah = [
                    'naik' => 'bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200',
                    'turun' => 'bg-red-50 text-red-700 ring-1 ring-red-200',
                    'stabil' => 'bg-gray-50 text-gray-700 ring-1 ring-gray-200',
                ][$tren['arah_tren']] ?? 'bg-gray-50 text-gray-700 ring-1 ring-gray-200';

                $prefixSelisih = $tren['selisih'] > 0 ? '+' : ($tren['selisih'] < 0 ? '-' : '');
                $persentasePerubahan = (float) $tren['persentase_perubahan'];
                $prefixPersentase = $persentasePerubahan > 0 ? '+' : '';
            @endphp

            <section class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
                <div class="mb-4 flex items-start justify-between gap-3">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Periode</p>
                        <h4 class="mt-1 text-xl font-bold text-gray-900">{{ $tren['nama_periode'] }}</h4>
                    </div>

                    <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-bold {{ $kelasArah }}">
                        @if ($tren['arah_tren'] === 'naik')
                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m5 15 7-7 7 7" />
                            </svg>
                        @elseif ($tren['arah_tren'] === 'turun')
                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7" />
                            </svg>
                        @else
                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14" />
                            </svg>
                        @endif
                        {{ ucfirst($tren['arah_tren']) }}
                    </span>
                </div>

                <div class="rounded-lg bg-gray-50 px-4 py-3">
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">{{ $tren['label_periode_saat_ini'] }}</p>
                    <p class="mt-1 text-2xl font-bold text-gray-900">Rp{{ number_format((float) $tren['total_saat_ini'], 0, ',', '.') }}</p>
                </div>

                <div class="mt-3 rounded-lg bg-gray-50 px-4 py-3">
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">{{ $tren['label_periode_sebelumnya'] }}</p>
                    <p class="mt-1 text-lg font-semibold text-gray-700">Rp{{ number_format((float) $tren['total_sebelumnya'], 0, ',', '.') }}</p>
                </div>

                <div class="mt-4 grid grid-cols-2 gap-3 text-sm">
                    <div class="rounded-lg border border-gray-200 px-3 py-2">
                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Selisih</p>
                        <p class="mt-1 font-bold text-gray-800">
                            {{ $prefixSelisih }}Rp{{ number_format(abs((float) $tren['selisih']), 0, ',', '.') }}
                        </p>
                    </div>
                    <div class="rounded-lg border border-gray-200 px-3 py-2">
                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Perubahan</p>
                        <p class="mt-1 font-bold text-gray-800">{{ $prefixPersentase }}{{ number_format($persentasePerubahan, 2, ',', '.') }}%</p>
                    </div>
                </div>
            </section>
        @endforeach
    </div>
</x-owner-layout>
