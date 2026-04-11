<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        $catBall = Category::create(['name' => 'Ball Bearings', 'slug' => Str::slug('Ball Bearings')]);
        $catRoller = Category::create(['name' => 'Roller Bearings', 'slug' => Str::slug('Roller Bearings')]);
        $catThrust = Category::create(['name' => 'Thrust Bearings', 'slug' => Str::slug('Thrust Bearings')]);

        Product::create([
            'category_id' => $catBall->id,
            'name' => 'Deep Groove Ball Bearing 6204',
            'sku' => 'BR-6204-ZZ',
            'inner_diameter' => 20.00,
            'outer_diameter' => 47.00,
            'thickness' => 14.00,
            'price' => 55000,
            'stock' => 100,
            'description' => 'Bantalan bola alur dalam yang paling umum digunakan, tipe "ZZ" memiliki penutup logam di kedua sisinya untuk melindungi dari debu.',
        ]);

        Product::create([
            'category_id' => $catRoller->id,
            'name' => 'Tapered Roller Bearing 32205',
            'sku' => 'TRB-32205',
            'inner_diameter' => 25.00,
            'outer_diameter' => 52.00,
            'thickness' => 19.25,
            'price' => 125000,
            'stock' => 50,
            'description' => 'Bantalan rol presisi untuk menangani beban radial dan aksial gabungan.',
        ]);

        Product::create([
            'category_id' => $catBall->id,
            'name' => 'Miniature Ball Bearing 608',
            'sku' => 'BR-608-2RS',
            'inner_diameter' => 8.00,
            'outer_diameter' => 22.00,
            'thickness' => 7.00,
            'price' => 15000,
            'stock' => 500,
            'description' => 'Bearing miniatur populer, sempurna untuk aplikasi presisi tinggi seperti skateboard dan motor listrik kecil.',
        ]);

        Product::create([
            'category_id' => $catThrust->id,
            'name' => 'Thrust Ball Bearing 51105',
            'sku' => 'TBB-51105',
            'inner_diameter' => 25.00,
            'outer_diameter' => 42.00,
            'thickness' => 11.00,
            'price' => 85000,
            'stock' => 30,
            'description' => 'Bantalan aksial (thrust) yang menahan beban aksial besar untuk aplikasi rotasi pelan.',
        ]);
        
        Product::create([
            'category_id' => $catRoller->id,
            'name' => 'Cylindrical Roller Bearing NU205',
            'sku' => 'CRB-NU205',
            'inner_diameter' => 25.00,
            'outer_diameter' => 52.00,
            'thickness' => 15.00,
            'price' => 110000,
            'stock' => 75,
            'description' => 'Roller bearing silinder tahan lama yang optimal untuk tugas berat dan kecepatan tinggi.',
        ]);
    }
}
