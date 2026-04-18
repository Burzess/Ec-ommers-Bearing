<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use App\Models\ShippingCity;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();
        $cart = $user->cart()->with('items.product')->firstOrCreate([]);

        $shippingCities = ShippingCity::query()
            ->active()
            ->orderBy('name')
            ->get();

        $paymentMethods = PaymentMethod::query()
            ->active()
            ->ordered()
            ->get();

        $selectedShippingCityId = (int) $request->query('shipping_city_id', $user->shipping_city_id ?? 0);
        $selectedShippingCity = $shippingCities->firstWhere('id', $selectedShippingCityId) ?? $shippingCities->first();

        $selectedPaymentCode = (string) $request->query('payment_method', '');
        $selectedPaymentMethod = $paymentMethods->firstWhere('code', $selectedPaymentCode) ?? $paymentMethods->first();

        $cartTotal = (float) $cart->items->sum(function ($item): float {
            return ((float) $item->product->price) * $item->quantity;
        });

        $shippingCost = (float) ($selectedShippingCity?->shipping_cost ?? 0);
        $grandTotal = $cartTotal + $shippingCost;

        return view('payment.index', [
            'cart' => $cart,
            'user' => $user,
            'shippingCities' => $shippingCities,
            'paymentMethods' => $paymentMethods,
            'selectedShippingCity' => $selectedShippingCity,
            'selectedPaymentMethod' => $selectedPaymentMethod,
            'cartTotal' => $cartTotal,
            'shippingCost' => $shippingCost,
            'grandTotal' => $grandTotal,
        ]);
    }
}
