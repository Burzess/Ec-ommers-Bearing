<?php

namespace App\Actions;

use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\ShippingCity;
use App\Models\User;
use DomainException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PlaceOrderAction
{
    public function handle(User $user, int $shippingCityId, string $paymentMethodCode): Order
    {
        return DB::transaction(function () use ($user, $shippingCityId, $paymentMethodCode): Order {
            if (trim((string) $user->address) === '' || trim((string) $user->phone) === '') {
                throw new DomainException('Lengkapi alamat dan nomor telepon terlebih dahulu sebelum checkout.');
            }

            $shippingCity = ShippingCity::query()
                ->active()
                ->find($shippingCityId);

            if (! $shippingCity) {
                throw new DomainException('Kota pengiriman tidak tersedia.');
            }

            $paymentMethod = PaymentMethod::query()
                ->active()
                ->where('code', $paymentMethodCode)
                ->first();

            if (! $paymentMethod) {
                throw new DomainException('Metode pembayaran tidak tersedia.');
            }

            $cart = $user->cart()->lockForUpdate()->first();

            if (! $cart) {
                throw new DomainException('Keranjang belanja Anda kosong.');
            }

            $cartItems = $cart->items()
                ->with('product')
                ->lockForUpdate()
                ->get();

            if ($cartItems->isEmpty()) {
                throw new DomainException('Keranjang belanja Anda kosong.');
            }

            $products = Product::query()
                ->whereIn('id', $cartItems->pluck('product_id'))
                ->lockForUpdate()
                ->get()
                ->keyBy('id');

            $subtotal = 0.0;

            foreach ($cartItems as $cartItem) {
                $product = $products->get($cartItem->product_id);

                if (! $product) {
                    throw new DomainException('Salah satu produk di keranjang tidak ditemukan.');
                }

                if ($product->stock < $cartItem->quantity) {
                    throw new DomainException("Stok produk {$product->name} tidak mencukupi.");
                }

                $subtotal += ((float) $product->price) * $cartItem->quantity;
            }

            $shippingCost = (float) $shippingCity->shipping_cost;
            $grandTotal = $subtotal + $shippingCost;

            $order = $user->orders()->create([
                'invoice_number' => $this->generateInvoiceNumber(),
                'subtotal_price' => $subtotal,
                'shipping_cost' => $shippingCost,
                'shipping_city_name' => $shippingCity->name,
                'payment_method_code' => $paymentMethod->code,
                'payment_method_name' => $paymentMethod->name,
                'payment_instruction' => $paymentMethod->description,
                'shipping_address' => $user->address,
                'shipping_phone' => $user->phone,
                'shipping_postal_code' => $user->postal_code,
                'total_price' => $grandTotal,
                'status' => Order::STATUS_PENDING,
            ]);

            foreach ($cartItems as $cartItem) {
                $product = $products->get($cartItem->product_id);

                $order->items()->create([
                    'product_id' => $product->id,
                    'quantity' => $cartItem->quantity,
                    'price' => (float) $product->price,
                ]);

                $product->decrement('stock', $cartItem->quantity);
            }

            $cart->items()->delete();

            $user->forceFill([
                'shipping_city_id' => $shippingCity->id,
            ])->save();

            return $order;
        }, 3);
    }

    private function generateInvoiceNumber(): string
    {
        do {
            $invoiceNumber = 'INV-'.now()->format('YmdHisv').'-'.Str::upper(Str::random(3));
        } while (Order::query()->where('invoice_number', $invoiceNumber)->exists());

        return $invoiceNumber;
    }
}
