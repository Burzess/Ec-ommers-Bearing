<?php

namespace Tests\Feature\Payment;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class TransferPaymentFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_buyer_bisa_upload_bukti_transfer_pada_order_transfer_pending(): void
    {
        Storage::fake('public');

        $buyer = User::factory()->create();

        $order = Order::query()->create([
            'user_id' => $buyer->id,
            'invoice_number' => 'INV-TRF-001',
            'subtotal_price' => 100000,
            'shipping_cost' => 15000,
            'total_price' => 115000,
            'status' => Order::STATUS_PENDING,
            'payment_method_code' => 'transfer_bca',
            'payment_method_name' => 'Transfer BCA',
        ]);

        $response = $this
            ->actingAs($buyer)
            ->from(route('orders.show', $order))
            ->post(route('orders.payment-proof.store', $order), [
                'payment_proof' => UploadedFile::fake()->image('bukti-transfer.png'),
            ]);

        $response
            ->assertRedirect(route('orders.show', $order))
            ->assertSessionHas('success');

        $order->refresh();

        $this->assertNotNull($order->payment_proof_path);
        $this->assertNotNull($order->payment_proof_uploaded_at);
        $this->assertSame(Order::STATUS_PENDING, $order->status);

        Storage::disk('public')->assertExists($order->payment_proof_path);
    }

    public function test_buyer_tidak_bisa_upload_bukti_transfer_untuk_order_cod(): void
    {
        Storage::fake('public');

        $buyer = User::factory()->create();

        $order = Order::query()->create([
            'user_id' => $buyer->id,
            'invoice_number' => 'INV-COD-001',
            'subtotal_price' => 100000,
            'shipping_cost' => 15000,
            'total_price' => 115000,
            'status' => Order::STATUS_PENDING,
            'payment_method_code' => 'cod',
            'payment_method_name' => 'Cash On Delivery',
        ]);

        $response = $this
            ->actingAs($buyer)
            ->from(route('orders.show', $order))
            ->post(route('orders.payment-proof.store', $order), [
                'payment_proof' => UploadedFile::fake()->image('bukti-transfer.png'),
            ]);

        $response
            ->assertRedirect(route('orders.show', $order))
            ->assertSessionHas('error', 'Bukti transfer hanya berlaku untuk metode pembayaran transfer.');

        $this->assertNull($order->fresh()->payment_proof_path);
    }

    public function test_admin_bisa_verifikasi_bukti_transfer_dan_status_jadi_paid(): void
    {
        Storage::fake('public');

        $admin = User::factory()->admin()->create();
        $buyer = User::factory()->create();

        $proofPath = UploadedFile::fake()->image('bukti-cek.png')->store('payment-proofs', 'public');

        $order = Order::query()->create([
            'user_id' => $buyer->id,
            'invoice_number' => 'INV-TRF-002',
            'subtotal_price' => 100000,
            'shipping_cost' => 15000,
            'total_price' => 115000,
            'status' => Order::STATUS_PENDING,
            'payment_method_code' => 'tf',
            'payment_method_name' => 'TF Manual',
            'payment_proof_path' => $proofPath,
            'payment_proof_uploaded_at' => now(),
        ]);

        $response = $this
            ->actingAs($admin)
            ->from(route('admin.orders.show', $order))
            ->post(route('admin.orders.transfer-proof.review', $order), [
                'action' => 'verify',
            ]);

        $response
            ->assertRedirect(route('admin.orders.show', $order))
            ->assertSessionHas('success');

        $order->refresh();

        $this->assertSame(Order::STATUS_PAID, $order->status);
        $this->assertNotNull($order->payment_verified_at);
        $this->assertSame($admin->id, $order->payment_verified_by);
    }

    public function test_admin_bisa_menolak_bukti_transfer_dan_buyer_harus_upload_ulang(): void
    {
        Storage::fake('public');

        $admin = User::factory()->admin()->create();
        $buyer = User::factory()->create();

        $proofPath = UploadedFile::fake()->image('bukti-salah.png')->store('payment-proofs', 'public');

        $order = Order::query()->create([
            'user_id' => $buyer->id,
            'invoice_number' => 'INV-TRF-003',
            'subtotal_price' => 100000,
            'shipping_cost' => 15000,
            'total_price' => 115000,
            'status' => Order::STATUS_PENDING,
            'payment_method_code' => 'transfer_bca',
            'payment_method_name' => 'Transfer BCA',
            'payment_proof_path' => $proofPath,
            'payment_proof_uploaded_at' => now(),
        ]);

        $response = $this
            ->actingAs($admin)
            ->from(route('admin.orders.show', $order))
            ->post(route('admin.orders.transfer-proof.review', $order), [
                'action' => 'reject',
                'note' => 'Nominal transfer tidak sesuai total tagihan.',
            ]);

        $response
            ->assertRedirect(route('admin.orders.show', $order))
            ->assertSessionHas('success');

        $order->refresh();

        $this->assertSame(Order::STATUS_PENDING, $order->status);
        $this->assertNull($order->payment_proof_path);
        $this->assertNull($order->payment_proof_uploaded_at);
        $this->assertSame('Nominal transfer tidak sesuai total tagihan.', $order->payment_verification_note);

        Storage::disk('public')->assertMissing($proofPath);
    }

    public function test_admin_tidak_bisa_ubah_status_paid_jika_order_transfer_belum_ada_bukti(): void
    {
        $admin = User::factory()->admin()->create();
        $buyer = User::factory()->create();

        $order = Order::query()->create([
            'user_id' => $buyer->id,
            'invoice_number' => 'INV-TRF-004',
            'subtotal_price' => 100000,
            'shipping_cost' => 15000,
            'total_price' => 115000,
            'status' => Order::STATUS_PENDING,
            'payment_method_code' => 'transfer_bca',
            'payment_method_name' => 'Transfer BCA',
        ]);

        $response = $this
            ->actingAs($admin)
            ->from(route('admin.orders.show', $order))
            ->put(route('admin.orders.update', $order), [
                'status' => Order::STATUS_PAID,
            ]);

        $response
            ->assertRedirect(route('admin.orders.show', $order))
            ->assertSessionHas('error', 'Pesanan transfer belum memiliki bukti transfer dari buyer.');

        $this->assertSame(Order::STATUS_PENDING, $order->fresh()->status);
    }
}
