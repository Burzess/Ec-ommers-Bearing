<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderPaymentProofRequest;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function show(Request $request, Order $order): View
    {
        abort_unless((int) $order->user_id === (int) $request->user()->id, 404);

        $order->load(['items.product.category', 'paymentVerifier']);

        return view('orders.show', [
            'order' => $order,
        ]);
    }

    public function uploadPaymentProof(StoreOrderPaymentProofRequest $request, Order $order): RedirectResponse
    {
        abort_unless((int) $order->user_id === (int) $request->user()->id, 404);

        if (! $order->isTransferPayment()) {
            return back()->with('error', 'Bukti transfer hanya berlaku untuk metode pembayaran transfer.');
        }

        if (! $order->canUploadTransferProof()) {
            return back()->with('error', 'Bukti transfer hanya bisa diunggah saat pesanan menunggu pembayaran.');
        }

        if ($order->payment_proof_path) {
            Storage::disk('public')->delete($order->payment_proof_path);
        }

        $paymentProofPath = $request->file('payment_proof')->store('payment-proofs', 'public');

        $order->update([
            'payment_proof_path' => $paymentProofPath,
            'payment_proof_uploaded_at' => now(),
            'payment_verified_at' => null,
            'payment_verified_by' => null,
            'payment_verification_note' => null,
        ]);

        return back()->with('success', 'Bukti transfer berhasil diunggah. Menunggu verifikasi admin.');
    }
}
