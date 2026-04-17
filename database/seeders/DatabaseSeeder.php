<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // USERS
        User::factory()->create([
            'name'     => 'Admin Asian Bearindo',
            'email'    => 'admin@asianbearindo.com',
            'username' => 'admin',
            'phone'    => '081234567890',
            'address'  => 'Jl. Tanjungsari No.19, Sukomanunggal, Surabaya',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        User::factory()->create([
            'name'     => 'Budi Santoso',
            'email'    => 'budi@example.com',
            'username' => 'budi',
            'phone'    => '081298765432',
            'address'  => 'Jl. Raya Darmo No.45, Surabaya',
            'password' => bcrypt('password'),
        ]);
        // CATEGORIES
        $catBall    = Category::create(['name' => 'Ball Bearings',    'slug' => 'ball-bearings']);
        $catRoller  = Category::create(['name' => 'Roller Bearings',  'slug' => 'roller-bearings']);
        $catThrust  = Category::create(['name' => 'Thrust Bearings',  'slug' => 'thrust-bearings']);
        $catNeedle  = Category::create(['name' => 'Needle Bearings',  'slug' => 'needle-bearings']);
        $catPillow  = Category::create(['name' => 'Pillow Block',     'slug' => 'pillow-block']);
        $catSelf    = Category::create(['name' => 'Self-Aligning',    'slug' => 'self-aligning']);
        $catAngular = Category::create(['name' => 'Angular Contact',  'slug' => 'angular-contact']);

        // PRODUCTS — Ball Bearings
        Product::create([
            'category_id'    => $catBall->id,
            'name'           => 'SKF Deep Groove Ball Bearing 6204-2Z',
            'sku'            => 'SKF-6204-2Z',
            'inner_diameter' => 20.00,
            'outer_diameter' => 47.00,
            'thickness'      => 14.00,
            'price'          => 75000,
            'stock'          => 120,
            'image'          => 'products/ball_bearing.jpeg',
            'description'    => 'Bantalan bola alur dalam SKF berkualitas tinggi dengan pelindung logam di kedua sisi (2Z). Sangat cocok untuk motor listrik, pompa, dan peralatan industri umum. Kapasitas beban dinamis 12.7 kN.',
        ]);
        Product::create([
            'category_id'    => $catBall->id,
            'name'           => 'NSK Deep Groove Ball Bearing 6205-DDU',
            'sku'            => 'NSK-6205-DDU',
            'inner_diameter' => 25.00,
            'outer_diameter' => 52.00,
            'thickness'      => 15.00,
            'price'          => 85000,
            'stock'          => 90,
            'image'          => 'products/ball_bearing.jpeg',
            'description'    => 'NSK 6205-DDU menggunakan seal kontak rendah di kedua sisi untuk perlindungan optimal terhadap kontaminasi. Ideal untuk conveyor, mesin pertanian, dan aplikasi umum industri.',
        ]);
        Product::create([
            'category_id'    => $catBall->id,
            'name'           => 'NTN Miniature Ball Bearing 608-ZZ',
            'sku'            => 'NTN-608-ZZ',
            'inner_diameter' => 8.00,
            'outer_diameter' => 22.00,
            'thickness'      => 7.00,
            'price'          => 18000,
            'stock'          => 500,
            'image'          => 'products/ball_bearing.png',
            'description'    => 'Bearing miniatur NTN yang populer untuk aplikasi ringan dan presisi tinggi. Digunakan pada skateboard, printer 3D, motor drone, dan peralatan elektronik.',
        ]);
        Product::create([
            'category_id'    => $catBall->id,
            'name'           => 'FAG Deep Groove Ball Bearing 6206-C3',
            'sku'            => 'FAG-6206-C3',
            'inner_diameter' => 30.00,
            'outer_diameter' => 62.00,
            'thickness'      => 16.00,
            'price'          => 95000,
            'stock'          => 65,
            'image'          => 'products/ball_bearing.png',
            'description'    => 'FAG 6206 dengan clearance C3 (lebih besar dari normal), cocok untuk aplikasi suhu tinggi pada motor listrik dan gearbox. Kapasitas beban dinamis 19.5 kN.',
        ]);
        Product::create([
            'category_id'    => $catBall->id,
            'name'           => 'KOYO Deep Groove Ball Bearing 6208-2RS',
            'sku'            => 'KOYO-6208-2RS',
            'inner_diameter' => 40.00,
            'outer_diameter' => 80.00,
            'thickness'      => 18.00,
            'price'          => 125000,
            'stock'          => 45,
            'image'          => 'products/ball_bearing.jpeg',
            'description'    => 'KOYO 6208 dengan rubber seal di kedua sisi (2RS). Tahan air, debu, dan kontaminan. Direkomendasikan untuk mesin pengolahan makanan dan lingkungan lembap.',
        ]);

        // PRODUCTS — Roller Bearings
        Product::create([
            'category_id'    => $catRoller->id,
            'name'           => 'NSK Tapered Roller Bearing 32205',
            'sku'            => 'NSK-32205',
            'inner_diameter' => 25.00,
            'outer_diameter' => 52.00,
            'thickness'      => 19.25,
            'price'          => 145000,
            'stock'          => 55,
            'image'          => 'products/roller_bearing.jpeg',
            'description'    => 'Bearing taper roller NSK untuk menangani beban radial dan aksial gabungan. Banyak digunakan pada hub roda kendaraan, gearbox industri, dan mesin konstruksi.',
        ]);
        Product::create([
            'category_id'    => $catRoller->id,
            'name'           => 'SKF Cylindrical Roller Bearing NU205-ECP',
            'sku'            => 'SKF-NU205-ECP',
            'inner_diameter' => 25.00,
            'outer_diameter' => 52.00,
            'thickness'      => 15.00,
            'price'          => 165000,
            'stock'          => 40,
            'image'          => 'products/roller_bearing.png',
            'description'    => 'SKF NU205 tipe Explorer, dirancang untuk kecepatan tinggi dan beban radial berat. Cage polimer (ECP) mengurangi gesekan sehingga cocok untuk spindle mesin CNC.',
        ]);
        Product::create([
            'category_id'    => $catRoller->id,
            'name'           => 'FAG Tapered Roller Bearing 30206-A',
            'sku'            => 'FAG-30206-A',
            'inner_diameter' => 30.00,
            'outer_diameter' => 62.00,
            'thickness'      => 17.25,
            'price'          => 155000,
            'stock'          => 60,
            'image'          => 'products/roller_bearing.jpeg',
            'description'    => 'FAG 30206-A adalah tapered roller bearing presisi tinggi untuk menahan beban gabungan pada transmisi dan differential kendaraan berat.',
        ]);
        Product::create([
            'category_id'    => $catRoller->id,
            'name'           => 'TIMKEN Tapered Roller Bearing 32007X',
            'sku'            => 'TIM-32007X',
            'inner_diameter' => 35.00,
            'outer_diameter' => 62.00,
            'thickness'      => 18.00,
            'price'          => 185000,
            'stock'          => 30,
            'image'          => 'products/roller_bearing.png',
            'description'    => 'TIMKEN 32007X merupakan bearing taper premium buatan USA yang unggul dalam ketahanan dan presisi. Sering dipakai di alat berat tambang dan konstruksi.',
        ]);

        // PRODUCTS — Thrust Bearings
        Product::create([
            'category_id'    => $catThrust->id,
            'name'           => 'SKF Thrust Ball Bearing 51105',
            'sku'            => 'SKF-51105',
            'inner_diameter' => 25.00,
            'outer_diameter' => 42.00,
            'thickness'      => 11.00,
            'price'          => 95000,
            'stock'          => 35,
            'image'          => 'products/thrust_bearing.jpg',
            'description'    => 'Thrust bearing SKF untuk menahan beban aksial murni. Cocok untuk aplikasi rotasi lambat seperti jack screw, turntable, dan mekanisme clutch.',
        ]);
        Product::create([
            'category_id'    => $catThrust->id,
            'name'           => 'NSK Thrust Ball Bearing 51200',
            'sku'            => 'NSK-51200',
            'inner_diameter' => 10.00,
            'outer_diameter' => 26.00,
            'thickness'      => 11.00,
            'price'          => 55000,
            'stock'          => 80,
            'image'          => 'products/thrust_bearing.jpg',
            'description'    => 'NSK 51200 thrust bearing ukuran kecil. Ideal untuk mesin yang memerlukan penanganan beban aksial pada kecepatan moderat, seperti mesin bor meja.',
        ]);
        Product::create([
            'category_id'    => $catThrust->id,
            'name'           => 'NTN Thrust Roller Bearing 81107',
            'sku'            => 'NTN-81107',
            'inner_diameter' => 35.00,
            'outer_diameter' => 52.00,
            'thickness'      => 12.00,
            'price'          => 175000,
            'stock'          => 25,
            'image'          => 'products/thrust_bearing.jpg',
            'description'    => 'NTN 81107 adalah cylindrical thrust roller bearing yang mampu menahan beban aksial sangat besar. Digunakan pada crane, press machine, dan extruder.',
        ]);

        // PRODUCTS — Needle Bearings
        Product::create([
            'category_id'    => $catNeedle->id,
            'name'           => 'INA Needle Roller Bearing HK2020',
            'sku'            => 'INA-HK2020',
            'inner_diameter' => 20.00,
            'outer_diameter' => 26.00,
            'thickness'      => 20.00,
            'price'          => 45000,
            'stock'          => 150,
            'image'          => 'products/needle_bearing.jpeg',
            'description'    => 'Drawn cup needle bearing INA yang sangat kompak. Desain hemat ruang tanpa inner ring, cocok digunakan langsung pada shaft yang sudah di-hardening.',
        ]);
        Product::create([
            'category_id'    => $catNeedle->id,
            'name'           => 'SKF Needle Roller Bearing NK20/16',
            'sku'            => 'SKF-NK20-16',
            'inner_diameter' => 20.00,
            'outer_diameter' => 28.00,
            'thickness'      => 16.00,
            'price'          => 65000,
            'stock'          => 90,
            'image'          => 'products/needle_bearing.jpeg',
            'description'    => 'SKF NK20/16 memiliki kapasitas beban radial tinggi relatif terhadap ukurannya. Sering dijumpai pada transmisi otomatis, pompa hidrolik, dan kompresor.',
        ]);
        Product::create([
            'category_id'    => $catNeedle->id,
            'name'           => 'IKO Needle Bearing NAF122413',
            'sku'            => 'IKO-NAF122413',
            'inner_diameter' => 12.00,
            'outer_diameter' => 24.00,
            'thickness'      => 13.00,
            'price'          => 52000,
            'stock'          => 70,
            'image'          => 'products/needle_bearing.jpeg',
            'description'    => 'IKO NAF adalah combined needle bearing yang memiliki cage dan thrust washer terintegrasi. Dirancang untuk menahan beban radial sekaligus aksial dalam satu unit.',
        ]);

        // PRODUCTS — Pillow Block
        Product::create([
            'category_id'    => $catPillow->id,
            'name'           => 'ASAHI Pillow Block Bearing UCP205',
            'sku'            => 'ASH-UCP205',
            'inner_diameter' => 25.00,
            'outer_diameter' => null,
            'thickness'      => null,
            'price'          => 135000,
            'stock'          => 85,
            'image'          => 'products/pillow_block.png',
            'description'    => 'Unit pillow block ASAHI cast iron dengan insert bearing UC205. Sistem set-screw locking yang memudahkan pemasangan pada shaft. Populer untuk conveyor dan fan.',
        ]);
        Product::create([
            'category_id'    => $catPillow->id,
            'name'           => 'FYH Pillow Block Bearing UCP208',
            'sku'            => 'FYH-UCP208',
            'inner_diameter' => 40.00,
            'outer_diameter' => null,
            'thickness'      => null,
            'price'          => 195000,
            'stock'          => 40,
            'image'          => 'products/pillow_block.png',
            'description'    => 'FYH UCP208 heavy-duty pillow block untuk shaft 40mm. Housing besi cor tahan korosi dengan grease fitting Zerk untuk re-lubrication.',
        ]);
        Product::create([
            'category_id'    => $catPillow->id,
            'name'           => 'NTN Pillow Block Bearing UCFL204',
            'sku'            => 'NTN-UCFL204',
            'inner_diameter' => 20.00,
            'outer_diameter' => null,
            'thickness'      => null,
            'price'          => 110000,
            'stock'          => 95,
            'image'          => 'products/pillow_block.png',
            'description'    => 'Flanged pillow block NTN dengan 2-bolt mounting. Compact design untuk aplikasi pemasangan di dinding atau permukaan vertikal.',
        ]);

        // PRODUCTS — Self-Aligning
        Product::create([
            'category_id'    => $catSelf->id,
            'name'           => 'SKF Self-Aligning Ball Bearing 2205 ETN9',
            'sku'            => 'SKF-2205-ETN9',
            'inner_diameter' => 25.00,
            'outer_diameter' => 52.00,
            'thickness'      => 18.00,
            'price'          => 185000,
            'stock'          => 35,
            'image'          => 'products/spherical_bearing.jpeg',
            'description'    => 'Bearing self-aligning SKF dengan cage polimer yang mampu mengoreksi misalignment shaft hingga 3°. Sangat efektif untuk mesin wood processing dan textile.',
        ]);
        Product::create([
            'category_id'    => $catSelf->id,
            'name'           => 'FAG Spherical Roller Bearing 22210-E1-K',
            'sku'            => 'FAG-22210-E1K',
            'inner_diameter' => 50.00,
            'outer_diameter' => 90.00,
            'thickness'      => 23.00,
            'price'          => 385000,
            'stock'          => 15,
            'image'          => 'products/spherical_bearing.jpeg',
            'description'    => 'Spherical roller bearing FAG generasi E1 yang dioptimalkan untuk beban berat dan misalignment. Tapered bore (K) memudahkan pemasangan pada sleeve adapter.',
        ]);

        // PRODUCTS — Angular Contact
        Product::create([
            'category_id'    => $catAngular->id,
            'name'           => 'NSK Angular Contact Ball Bearing 7205-BECBP',
            'sku'            => 'NSK-7205-BECBP',
            'inner_diameter' => 25.00,
            'outer_diameter' => 52.00,
            'thickness'      => 15.00,
            'price'          => 210000,
            'stock'          => 30,
            'image'          => 'products/angular_contact_bearing.jpeg',
            'description'    => 'Angular contact bearing NSK dengan sudut kontak 40° untuk menangani beban aksial dominan. Cage polimer memungkinkan kecepatan putaran sangat tinggi pada spindle.',
        ]);
        Product::create([
            'category_id'    => $catAngular->id,
            'name'           => 'SKF Angular Contact Ball Bearing 7206-BEP',
            'sku'            => 'SKF-7206-BEP',
            'inner_diameter' => 30.00,
            'outer_diameter' => 62.00,
            'thickness'      => 16.00,
            'price'          => 245000,
            'stock'          => 25,
            'image'          => 'products/angular_contact_bearing.jpeg',
            'description'    => 'SKF 7206-BEP angular contact bearing 40°, single row. Cocok untuk paired mounting pada spindle mesin bubut dan milling CNC.',
        ]);
        Product::create([
            'category_id'    => $catAngular->id,
            'name'           => 'NTN Angular Contact Bearing 7208B',
            'sku'            => 'NTN-7208B',
            'inner_diameter' => 40.00,
            'outer_diameter' => 80.00,
            'thickness'      => 18.00,
            'price'          => 275000,
            'stock'          => 20,
            'image'          => 'products/angular_contact_bearing.jpeg',
            'description'    => 'NTN 7208B untuk aplikasi kecepatan tinggi dan presisi. Sudut kontak 40° memberikan kapasitas beban aksial superior. Direkomendasikan untuk pompa sentrifugal dan turbocharger.',
        ]);
    }
}
