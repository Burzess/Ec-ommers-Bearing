<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DummyEcommerceSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Tambahkan User Buyer lebih banyak untuk variasi
        $buyers = [
            [
                'name' => 'Budi Santoso',
                'username' => 'budi',
                'email' => 'budi@example.com',
                'password' => bcrypt('password'),
                'role' => User::ROLE_BUYER,
                'phone' => '081234567891',
                'address' => 'Jl. Mawar No. 123, Surabaya',
                'postal_code' => '60123',
            ],
            [
                'name' => 'Siti Aminah',
                'username' => 'siti',
                'email' => 'siti@example.com',
                'password' => bcrypt('password'),
                'role' => User::ROLE_BUYER,
                'phone' => '081234567892',
                'address' => 'Jl. Melati No. 45, Sidoarjo',
                'postal_code' => '61234',
            ],
            [
                'name' => 'Agus Pratama',
                'username' => 'agus',
                'email' => 'agus@example.com',
                'password' => bcrypt('password'),
                'role' => User::ROLE_BUYER,
                'phone' => '081234567893',
                'address' => 'Jl. Kenanga No. 7, Gresik',
                'postal_code' => '61123',
            ],
            [
                'name' => 'Dewi Lestari',
                'username' => 'dewi',
                'email' => 'dewi@example.com',
                'password' => bcrypt('password'),
                'role' => User::ROLE_BUYER,
                'phone' => '081234567894',
                'address' => 'Jl. Anggrek No. 10, Surabaya',
                'postal_code' => '60231',
            ],
            [
                'name' => 'Hendra Wijaya',
                'username' => 'hendra',
                'email' => 'hendra@example.com',
                'password' => bcrypt('password'),
                'role' => User::ROLE_BUYER,
                'phone' => '081234567895',
                'address' => 'Jl. Gajah Mada No. 88, Jakarta',
                'postal_code' => '10110',
            ],
        ];

        foreach ($buyers as $buyerData) {
            User::query()->updateOrCreate(['email' => $buyerData['email']], $buyerData);
        }

        $allBuyers = User::where('role', User::ROLE_BUYER)->get();
        $products = Product::all();

        if ($products->isEmpty()) {
            return;
        }

        // Hapus data order lama agar bersih dan tidak tumpang tindih
        Order::query()->delete();

        // 2. Simulasi Pesanan (Orders)
        // Kita buat data untuk 14 hari terakhir agar grafik mingguan juga terisi
        for ($day = 0; $day <= 14; $day++) {
            $date = now()->subDays($day);
            
            // Buat 2-4 pesanan per hari agar grafik terlihat ramai
            $ordersPerDay = rand(2, 4);
            
            for ($i = 0; $i < $ordersPerDay; $i++) {
                $buyer = $allBuyers->random();
                
                // Distribusi Status yang lebih nyata:
                // 70% status sukses (biar grafik pendapatan bagus)
                // 30% status lain (pending/cancelled)
                $statusRoll = rand(1, 10);
                if ($statusRoll <= 4) {
                    $status = Order::STATUS_COMPLETED; // Paling banyak selesai
                } elseif ($statusRoll <= 6) {
                    $status = Order::STATUS_PAID;      // Sedang dikemas
                } elseif ($statusRoll <= 7) {
                    $status = Order::STATUS_SHIPPED;   // Sedang dikirim
                } elseif ($statusRoll <= 9) {
                    $status = Order::STATUS_PENDING;   // Belum bayar
                } else {
                    $status = Order::STATUS_CANCELLED; // Dibatalkan
                }
                
                $order = Order::create([
                    'user_id' => $buyer->id,
                    'invoice_number' => 'INV/' . $date->format('Ymd') . '/' . strtoupper(Str::random(6)),
                    'total_price' => 0,
                    'status' => $status,
                    'created_at' => $date->copy()->subHours(rand(1, 23))->subMinutes(rand(0, 59)), 
                ]);

                $totalOrderPrice = 0;
                $itemCount = rand(1, 4); // 1-4 jenis produk per transaksi
                $selectedProducts = $products->random($itemCount);

                foreach ($selectedProducts as $product) {
                    $qty = rand(1, 5);
                    $price = $product->price;
                    $subtotal = $price * $qty;

                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'quantity' => $qty,
                        'price' => $price,
                    ]);

                    $totalOrderPrice += $subtotal;
                }

                $order->update(['total_price' => $totalOrderPrice]);
            }
        }
    }
}
