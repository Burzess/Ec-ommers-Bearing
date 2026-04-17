<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $now = now();

        $revenueStatuses = ['paid', 'shipped', 'completed'];

        $totalProducts = Product::count();
        $totalUsers = User::where(function (Builder $query): void {
            $query->whereNull('role')->orWhere('role', '!=', 'admin');
        })->count();

        $totalOrders = Order::count();
        $totalRevenue = (float) Order::whereIn('status', $revenueStatuses)->sum('total_price');

        $dailyRows = Order::query()
            ->selectRaw('DATE(created_at) as period, SUM(total_price) as total')
            ->whereIn('status', $revenueStatuses)
            ->whereDate('created_at', '>=', $now->copy()->subDays(6)->startOfDay())
            ->groupBy('period')
            ->pluck('total', 'period');

        $dailyLabels = [];
        $dailyValues = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = $now->copy()->subDays($i);
            $key = $date->toDateString();

            $dailyLabels[] = $date->translatedFormat('d M');
            $dailyValues[] = (float) ($dailyRows[$key] ?? 0);
        }

        $weeklyRows = Order::query()
            ->whereIn('status', $revenueStatuses)
            ->whereDate('created_at', '>=', $now->copy()->subWeeks(7)->startOfWeek(Carbon::MONDAY))
            ->get(['created_at', 'total_price'])
            ->groupBy(function (Order $order): string {
                return $order->created_at->format('o-W');
            })
            ->map(function ($orders): float {
                return (float) $orders->sum('total_price');
            });

        $weeklyLabels = [];
        $weeklyValues = [];

        for ($i = 7; $i >= 0; $i--) {
            $weekDate = $now->copy()->subWeeks($i);
            $key = $weekDate->format('o-W');

            $weeklyLabels[] = 'Mgg ' . $weekDate->format('W');
            $weeklyValues[] = (float) ($weeklyRows[$key] ?? 0);
        }

        $monthlyRows = Order::query()
            ->whereIn('status', $revenueStatuses)
            ->whereDate('created_at', '>=', $now->copy()->subMonths(5)->startOfMonth())
            ->get(['created_at', 'total_price'])
            ->groupBy(function (Order $order): string {
                return $order->created_at->format('Y-m');
            })
            ->map(function ($orders): float {
                return (float) $orders->sum('total_price');
            });

        $monthlyLabels = [];
        $monthlyValues = [];

        for ($i = 5; $i >= 0; $i--) {
            $monthDate = $now->copy()->subMonths($i);
            $key = $monthDate->format('Y-m');

            $monthlyLabels[] = $monthDate->translatedFormat('M Y');
            $monthlyValues[] = (float) ($monthlyRows[$key] ?? 0);
        }

        $orderStatusSummary = [
            [
                'label' => 'Pesanan Masuk',
                'count' => Order::where('status', 'pending')->count(),
                'status' => 'pending',
            ],
            [
                'label' => 'Dikemas',
                'count' => Order::where('status', 'paid')->count(),
                'status' => 'paid',
            ],
            [
                'label' => 'Dikirim',
                'count' => Order::where('status', 'shipped')->count(),
                'status' => 'shipped',
            ],
            [
                'label' => 'Selesai',
                'count' => Order::where('status', 'completed')->count(),
                'status' => 'completed',
            ],
        ];

        $trafficWindowStart = $now->copy()->subDays(30)->startOfDay();

        $uniqueTraffic = User::query()
            ->where(function (Builder $query): void {
                $query->whereNull('role')->orWhere('role', '!=', 'admin');
            })
            ->where(function (Builder $query) use ($trafficWindowStart): void {
                $query->whereDate('created_at', '>=', $trafficWindowStart)
                    ->orWhereHas('orders', function (Builder $orderQuery) use ($trafficWindowStart): void {
                        $orderQuery->whereDate('created_at', '>=', $trafficWindowStart);
                    });
            })
            ->count();

        $convertedTraffic = User::query()
            ->where(function (Builder $query): void {
                $query->whereNull('role')->orWhere('role', '!=', 'admin');
            })
            ->whereHas('orders', function (Builder $orderQuery) use ($trafficWindowStart): void {
                $orderQuery->whereDate('created_at', '>=', $trafficWindowStart);
            })
            ->count();

        $conversionRate = $uniqueTraffic > 0
            ? round(($convertedTraffic / $uniqueTraffic) * 100, 2)
            : 0;

        $lowStockThreshold = 5;
        $lowStockProducts = Product::query()
            ->with('category')
            ->where('stock', '<=', $lowStockThreshold)
            ->orderBy('stock')
            ->take(8)
            ->get();

        $recentOrders = Order::with('user')
            ->latest()
            ->take(5)
            ->get();

        $revenueChart = [
            'daily' => [
                'labels' => $dailyLabels,
                'values' => $dailyValues,
            ],
            'weekly' => [
                'labels' => $weeklyLabels,
                'values' => $weeklyValues,
            ],
            'monthly' => [
                'labels' => $monthlyLabels,
                'values' => $monthlyValues,
            ],
        ];

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalUsers',
            'totalOrders',
            'totalRevenue',
            'recentOrders',
            'revenueChart',
            'orderStatusSummary',
            'uniqueTraffic',
            'conversionRate',
            'lowStockProducts',
            'lowStockThreshold'
        ));
    }
}
