<?php

namespace Tests\Feature\Payment;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderDetailAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_buyer_bisa_melihat_detail_order_milik_sendiri(): void
    {
        $buyer = User::factory()->create();

        $order = Order::query()->create([
            'user_id' => $buyer->id,
            'invoice_number' => 'INV-TEST-001',
            'subtotal_price' => 100000,
            'shipping_cost' => 20000,
            'total_price' => 120000,
            'status' => Order::STATUS_PENDING,
        ]);

        $response = $this->actingAs($buyer)->get(route('orders.show', $order));

        $response->assertOk();
        $response->assertSee('INV-TEST-001');
    }

    public function test_buyer_tidak_bisa_melihat_order_milik_user_lain(): void
    {
        $ownerOrder = User::factory()->create();
        $otherBuyer = User::factory()->create();

        $order = Order::query()->create([
            'user_id' => $ownerOrder->id,
            'invoice_number' => 'INV-TEST-002',
            'subtotal_price' => 100000,
            'shipping_cost' => 20000,
            'total_price' => 120000,
            'status' => Order::STATUS_PENDING,
        ]);

        $response = $this->actingAs($otherBuyer)->get(route('orders.show', $order));

        $response->assertNotFound();
    }

    public function test_guest_dialihkan_ke_halaman_login_saat_akses_detail_order(): void
    {
        $buyer = User::factory()->create();

        $order = Order::query()->create([
            'user_id' => $buyer->id,
            'invoice_number' => 'INV-TEST-003',
            'subtotal_price' => 100000,
            'shipping_cost' => 20000,
            'total_price' => 120000,
            'status' => Order::STATUS_PENDING,
        ]);

        $response = $this->get(route('orders.show', $order));

        $response->assertRedirect(route('login'));
    }
}
