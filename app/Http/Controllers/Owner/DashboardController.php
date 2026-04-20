<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Services\Owner\RevenueTrendService;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(private readonly RevenueTrendService $revenueTrendService)
    {
    }

    public function index(): View
    {
        $ringkasanTrenPendapatan = $this->revenueTrendService->dapatkanRingkasanTren();

        return view('owner.dashboard', compact('ringkasanTrenPendapatan'));
    }
}
