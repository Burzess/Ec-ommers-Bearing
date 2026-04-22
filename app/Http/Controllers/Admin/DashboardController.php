<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $now = now();

        $totalProducts = Product::count();
        $totalUsers = User::where('role', User::ROLE_BUYER)->count();

        $totalOrders = Order::count();

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
            ->where('role', User::ROLE_BUYER)
            ->where(function (Builder $query) use ($trafficWindowStart): void {
                $query->whereDate('created_at', '>=', $trafficWindowStart)
                    ->orWhereHas('orders', function (Builder $orderQuery) use ($trafficWindowStart): void {
                        $orderQuery->whereDate('created_at', '>=', $trafficWindowStart);
                    });
            })
            ->count();

        $convertedTraffic = User::query()
            ->where('role', User::ROLE_BUYER)
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

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalUsers',
            'totalOrders',
            'recentOrders',
            'orderStatusSummary',
            'uniqueTraffic',
            'conversionRate',
            'lowStockProducts',
            'lowStockThreshold'
        ));
    }
}
