<?php

namespace App\Services\Owner;

use App\Models\Order;
use Carbon\Carbon;

class RevenueTrendService
{
    /**
     * @var array<int, string>
     */
    private const STATUS_PENDAPATAN = [
        Order::STATUS_PAID,
        Order::STATUS_SHIPPED,
        Order::STATUS_COMPLETED,
    ];

    /**
     * @return array<string, array<string, float|string>>
     */
    public function dapatkanRingkasanTren(): array
    {
        $waktuSekarang = now();

        return [
            'harian' => $this->hitungTrenPeriode(
                namaPeriode: 'Harian',
                labelPeriodeSaatIni: 'Hari Ini',
                labelPeriodeSebelumnya: 'Kemarin',
                mulaiSaatIni: $waktuSekarang->copy()->startOfDay(),
                akhirSaatIni: $waktuSekarang->copy()->endOfDay(),
                mulaiSebelumnya: $waktuSekarang->copy()->subDay()->startOfDay(),
                akhirSebelumnya: $waktuSekarang->copy()->subDay()->endOfDay(),
            ),
            'mingguan' => $this->hitungTrenPeriode(
                namaPeriode: 'Mingguan',
                labelPeriodeSaatIni: 'Minggu Ini',
                labelPeriodeSebelumnya: 'Minggu Lalu',
                mulaiSaatIni: $waktuSekarang->copy()->startOfWeek(Carbon::MONDAY),
                akhirSaatIni: $waktuSekarang->copy()->endOfWeek(Carbon::SUNDAY),
                mulaiSebelumnya: $waktuSekarang->copy()->subWeek()->startOfWeek(Carbon::MONDAY),
                akhirSebelumnya: $waktuSekarang->copy()->subWeek()->endOfWeek(Carbon::SUNDAY),
            ),
            'bulanan' => $this->hitungTrenPeriode(
                namaPeriode: 'Bulanan',
                labelPeriodeSaatIni: 'Bulan Ini',
                labelPeriodeSebelumnya: 'Bulan Lalu',
                mulaiSaatIni: $waktuSekarang->copy()->startOfMonth(),
                akhirSaatIni: $waktuSekarang->copy()->endOfMonth(),
                mulaiSebelumnya: $waktuSekarang->copy()->subMonth()->startOfMonth(),
                akhirSebelumnya: $waktuSekarang->copy()->subMonth()->endOfMonth(),
            ),
        ];
    }

    /**
     * @return array<string, float|string>
     */
    private function hitungTrenPeriode(
        string $namaPeriode,
        string $labelPeriodeSaatIni,
        string $labelPeriodeSebelumnya,
        Carbon $mulaiSaatIni,
        Carbon $akhirSaatIni,
        Carbon $mulaiSebelumnya,
        Carbon $akhirSebelumnya,
    ): array {
        $totalSaatIni = $this->ambilTotalPendapatan($mulaiSaatIni, $akhirSaatIni);
        $totalSebelumnya = $this->ambilTotalPendapatan($mulaiSebelumnya, $akhirSebelumnya);
        $selisih = $totalSaatIni - $totalSebelumnya;

        return [
            'nama_periode' => $namaPeriode,
            'label_periode_saat_ini' => $labelPeriodeSaatIni,
            'label_periode_sebelumnya' => $labelPeriodeSebelumnya,
            'total_saat_ini' => $totalSaatIni,
            'total_sebelumnya' => $totalSebelumnya,
            'selisih' => $selisih,
            'persentase_perubahan' => $this->hitungPersentasePerubahan($totalSaatIni, $totalSebelumnya),
            'arah_tren' => $this->tentukanArahTren($selisih),
        ];
    }

    private function ambilTotalPendapatan(Carbon $mulai, Carbon $akhir): float
    {
        return (float) Order::query()
            ->whereIn('status', self::STATUS_PENDAPATAN)
            ->whereBetween('created_at', [$mulai, $akhir])
            ->sum('total_price');
    }

    private function hitungPersentasePerubahan(float $totalSaatIni, float $totalSebelumnya): float
    {
        if ($totalSebelumnya <= 0) {
            return $totalSaatIni > 0 ? 100.0 : 0.0;
        }

        return round((($totalSaatIni - $totalSebelumnya) / $totalSebelumnya) * 100, 2);
    }

    private function tentukanArahTren(float $selisih): string
    {
        if ($selisih > 0) {
            return 'naik';
        }

        if ($selisih < 0) {
            return 'turun';
        }

        return 'stabil';
    }
}
