<?php

namespace Database\Seeders;

use App\Models\CompanySetting;
use App\Models\PaymentMethod;
use App\Models\ShippingCity;
use App\Models\User;
use Illuminate\Database\Seeder;

class MasterDataSeeder extends Seeder
{
    public function run(): void
    {
        $surabaya = ShippingCity::query()->updateOrCreate([
            'slug' => 'surabaya',
        ], [
            'name' => 'Surabaya',
            'shipping_cost' => 12000,
            'is_active' => true,
        ]);

        ShippingCity::query()->updateOrCreate([
            'slug' => 'sidoarjo',
        ], [
            'name' => 'Sidoarjo',
            'shipping_cost' => 15000,
            'is_active' => true,
        ]);

        ShippingCity::query()->updateOrCreate([
            'slug' => 'gresik',
        ], [
            'name' => 'Gresik',
            'shipping_cost' => 17000,
            'is_active' => true,
        ]);

        ShippingCity::query()->updateOrCreate([
            'slug' => 'bandung',
        ], [
            'name' => 'Bandung',
            'shipping_cost' => 22000,
            'is_active' => true,
        ]);

        ShippingCity::query()->updateOrCreate([
            'slug' => 'jakarta',
        ], [
            'name' => 'Jakarta',
            'shipping_cost' => 25000,
            'is_active' => true,
        ]);

        PaymentMethod::query()->updateOrCreate([
            'code' => 'bca_transfer',
        ], [
            'name' => 'Transfer Bank BCA',
            'description' => 'Pembayaran melalui transfer rekening BCA.',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        PaymentMethod::query()->updateOrCreate([
            'code' => 'debit_kredit',
        ], [
            'name' => 'Debit / Kredit',
            'description' => 'Pembayaran menggunakan kartu debit atau kredit.',
            'is_active' => true,
            'sort_order' => 2,
        ]);

        PaymentMethod::query()->updateOrCreate([
            'code' => 'cash_tunai',
        ], [
            'name' => 'Cash Tunai',
            'description' => 'Pembayaran tunai saat pengambilan barang.',
            'is_active' => true,
            'sort_order' => 3,
        ]);

        CompanySetting::query()->updateOrCreate([
            'id' => 1,
        ], [
            'company_name' => 'Asian Bearindo Jaya',
            'company_address' => 'Jl. Tanjungsari no. 19, Sukomanunggal Surabaya, Jawa Timur',
            'company_phone' => '+62 812-3456-7890',
            'company_email' => 'admin@asianbearindo.com',
            'business_days' => 'Senin - Jumat',
            'business_hours' => '08.00 - 17.00',
            'maps_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15831.43723628913!2d112.67946124076845!3d-7.25684857497332!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7ff936876686d%3A0xa3fa7db480604775!2sPT.%20Asian%20Bearindo%20Jaya%20(HQ)!5e0!3m2!1sid!2sid!4v1775962861342!5m2!1sid!2sid',
        ]);

        User::query()->updateOrCreate([
            'email' => 'owner@asianbearindo.com',
        ], [
            'name' => 'Owner Asian Bearindo',
            'username' => 'owner',
            'phone' => '081211110000',
            'address' => 'Jl. Tanjungsari No.19, Sukomanunggal, Surabaya',
            'shipping_city_id' => $surabaya->id,
            'postal_code' => '60188',
            'password' => bcrypt('password'),
            'role' => User::ROLE_OWNER,
        ]);

        User::query()->updateOrCreate([
            'email' => 'admin@asianbearindo.com',
        ], [
            'name' => 'Admin Asian Bearindo',
            'username' => 'admin',
            'phone' => '081234567890',
            'address' => 'Jl. Tanjungsari No.19, Sukomanunggal, Surabaya',
            'shipping_city_id' => $surabaya->id,
            'postal_code' => '60188',
            'password' => bcrypt('password'),
            'role' => User::ROLE_ADMIN,
        ]);

        User::query()->updateOrCreate([
            'email' => 'budi@example.com',
        ], [
            'name' => 'Budi Santoso',
            'username' => 'budi',
            'phone' => '081298765432',
            'address' => 'Jl. Raya Darmo No.45, Surabaya',
            'shipping_city_id' => $surabaya->id,
            'postal_code' => '60241',
            'password' => bcrypt('password'),
            'role' => User::ROLE_BUYER,
        ]);
    }
}
