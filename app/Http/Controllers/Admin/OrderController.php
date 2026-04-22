<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewTransferProofRequest;
use App\Http\Requests\UpdateAdminOrderStatusRequest;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('q', ''));
        $status = trim((string) $request->query('status', ''));
        $statuses = Order::statuses();

        $orders = Order::query()
            ->with('user')
            ->withCount('items')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery
                        ->where('invoice_number', 'like', "%{$search}%")
                        ->orWhereHas('user', function ($userQuery) use ($search) {
                            $userQuery
                                ->where('name', 'like', "%{$search}%")
                                ->orWhere('email', 'like', "%{$search}%")
                                ->orWhere('username', 'like', "%{$search}%");
                        });
                });
            })
            ->when(in_array($status, $statuses, true), function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->latest()
            ->get();

        return view('admin.orders.index', compact('orders', 'search', 'status', 'statuses'));
    }

    public function show(Order $order): View
    {
        $order->load(['user', 'items.product.category', 'paymentVerifier']);

        return view('admin.orders.show', [
            'order' => $order,
            'statuses' => Order::statuses(),
        ]);
    }

    public function update(UpdateAdminOrderStatusRequest $request, Order $order): RedirectResponse
    {
        $targetStatus = $request->validated()['status'];

        if (
            $targetStatus === Order::STATUS_PAID
            && $order->isTransferPayment()
            && ! $order->payment_proof_path
        ) {
            return back()->with('error', 'Pesanan transfer belum memiliki bukti transfer dari buyer.');
        }

        if (! $order->canTransitionTo($targetStatus)) {
            return back()->with('error', 'Transisi status tidak valid untuk pesanan ini.');
        }

        $payload = [
            'status' => $targetStatus,
        ];

        if ($targetStatus === Order::STATUS_PAID && $order->isTransferPayment()) {
            $payload['payment_verified_at'] = $order->payment_verified_at ?? now();
            $payload['payment_verified_by'] = $order->payment_verified_by ?? $request->user()->id;
            $payload['payment_verification_note'] = $order->payment_verification_note;
        }

        $order->update($payload);

        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }

    public function reviewTransferProof(ReviewTransferProofRequest $request, Order $order): RedirectResponse
    {
        if (! $order->isTransferPayment()) {
            return back()->with('error', 'Review bukti transfer hanya berlaku untuk metode transfer.');
        }

        if ($order->status !== Order::STATUS_PENDING) {
            return back()->with('error', 'Bukti transfer hanya bisa direview saat status pesanan masih pending.');
        }

        if (! $order->payment_proof_path) {
            return back()->with('error', 'Buyer belum mengunggah bukti transfer.');
        }

        $validated = $request->validated();

        if ($validated['action'] === 'verify') {
            $order->update([
                'status' => Order::STATUS_PAID,
                'payment_verified_at' => now(),
                'payment_verified_by' => $request->user()->id,
                'payment_verification_note' => $validated['note'] ?? null,
            ]);

            return back()->with('success', 'Pembayaran transfer berhasil diverifikasi dan status diubah menjadi PAID.');
        }

        Storage::disk('public')->delete($order->payment_proof_path);

        $order->update([
            'payment_proof_path' => null,
            'payment_proof_uploaded_at' => null,
            'payment_verified_at' => null,
            'payment_verified_by' => null,
            'payment_verification_note' => (string) $validated['note'],
        ]);

        return back()->with('success', 'Bukti transfer ditolak. Buyer diminta mengunggah ulang bukti transfer.');
    }

    public function destroy(Order $order): RedirectResponse
    {
        $order->delete();

        return redirect()
            ->route('admin.orders.index')
            ->with('success', 'Pesanan berhasil dihapus.');
    }
}
