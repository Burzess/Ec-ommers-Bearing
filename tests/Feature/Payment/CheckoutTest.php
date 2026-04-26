<?php

namespace Tests\Feature\Payment;

use App\Models\Category;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\ShippingCity;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class CheckoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_buyer_dapat_checkout_dan_order_terbuat(): void
    {
        $user = User::factory()->create([
            'address' => 'Jl. Melati No. 12',
            'phone' => '08123456789',
        ]);

        $shippingCity = ShippingCity::query()->create([
            'name' => 'Jakarta',
            'slug' => 'jakarta',
            'shipping_cost' => 50000,
            'is_active' => true,
        ]);

        $paymentMethod = PaymentMethod::query()->create([
            'code' => 'transfer_bca',
            'name' => 'Transfer BCA',
            'description' => 'Transfer manual',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $category = Category::query()->create([
            'name' => 'Bearing Umum',
            'slug' => 'bearing-umum',
        ]);

        $product = Product::query()->create([
            'category_id' => $category->id,
            'name' => 'Bearing 6204ZZ',
            'sku' => 'BRG-6204ZZ-'.Str::upper(Str::random(4)),
            'price' => 100000,
            'stock' => 10,
        ]);

        $cart = $user->cart()->create();
        $cart->items()->create([
            'product_id' => $product->id,
            'quantity' => 2,
        ]);

        $response = $this
            ->actingAs($user)
            ->post(route('payment.store'), [
                'shipping_city_id' => $shippingCity->id,
                'payment_method' => $paymentMethod->code,
            ]);

        $order = Order::query()->first();

        $this->assertNotNull($order);

        $response
            ->assertRedirect(route('orders.show', $order))
            ->assertSessionHas('success');

        $this->assertDatabaseCount('orders', 1);
        $this->assertStringStartsWith('INV-', $order->invoice_number);

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'user_id' => $user->id,
            'status' => Order::STATUS_PENDING,
            'subtotal_price' => 200000,
            'shipping_cost' => 50000,
            'total_price' => 250000,
            'shipping_city_name' => 'Jakarta',
            'payment_method_code' => 'transfer_bca',
            'payment_method_name' => 'Transfer BCA',
            'payment_instruction' => 'Transfer manual',
            'shipping_address' => 'Jl. Melati No. 12',
            'shipping_phone' => '08123456789',
        ]);

        $this->assertDatabaseHas('order_items', [
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => 2,
            'price' => 100000,
        ]);

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'stock' => 8,
        ]);

        $this->assertDatabaseCount('cart_items', 0);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'shipping_city_id' => $shippingCity->id,
        ]);
    }

    public function test_checkout_gagal_jika_stok_tidak_cukup(): void
    {
        $user = User::factory()->create([
            'address' => 'Jl. Kenanga No. 77',
            'phone' => '08123456780',
        ]);

        $shippingCity = ShippingCity::query()->create([
            'name' => 'Bandung',
            'slug' => 'bandung',
            'shipping_cost' => 20000,
            'is_active' => true,
        ]);

        $paymentMethod = PaymentMethod::query()->create([
            'code' => 'transfer_mandiri',
            'name' => 'Transfer Mandiri',
            'description' => 'Transfer manual',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $category = Category::query()->create([
            'name' => 'Bearing Industri',
            'slug' => 'bearing-industri',
        ]);

        $product = Product::query()->create([
            'category_id' => $category->id,
            'name' => 'Bearing 6305',
            'sku' => 'BRG-6305-'.Str::upper(Str::random(4)),
            'price' => 80000,
            'stock' => 1,
        ]);

        $cart = $user->cart()->create();
        $cart->items()->create([
            'product_id' => $product->id,
            'quantity' => 2,
        ]);

        $response = $this
            ->actingAs($user)
            ->post(route('payment.store'), [
                'shipping_city_id' => $shippingCity->id,
                'payment_method' => $paymentMethod->code,
            ]);

        $response
            ->assertRedirect(route('payment.index', [
                'shipping_city_id' => $shippingCity->id,
                'payment_method' => $paymentMethod->code,
            ]))
            ->assertSessionHas('error', 'Stok produk Bearing 6305 tidak mencukupi.');

        $this->assertDatabaseCount('orders', 0);

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'stock' => 1,
        ]);

        $this->assertDatabaseHas('cart_items', [
            'cart_id' => $cart->id,
            'product_id' => $product->id,
            'quantity' => 2,
        ]);
    }
}
