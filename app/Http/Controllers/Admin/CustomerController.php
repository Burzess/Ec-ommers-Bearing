<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\View\View;

class CustomerController extends Controller
{
    public function index(): View
    {
        $customers = User::query()
            ->where('role', User::ROLE_BUYER)
            ->withCount('orders')
            ->latest()
            ->get();

        return view('admin.customers.index', compact('customers'));
    }
}
