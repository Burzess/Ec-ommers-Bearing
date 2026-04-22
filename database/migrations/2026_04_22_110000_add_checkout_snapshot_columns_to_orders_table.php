<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('subtotal_price', 12, 2)->default(0);
            $table->decimal('shipping_cost', 12, 2)->default(0);
            $table->string('shipping_city_name')->nullable();
            $table->string('payment_method_code')->nullable();
            $table->string('payment_method_name')->nullable();
            $table->string('payment_instruction')->nullable();
            $table->text('shipping_address')->nullable();
            $table->string('shipping_phone', 30)->nullable();
            $table->string('shipping_postal_code', 20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'subtotal_price',
                'shipping_cost',
                'shipping_city_name',
                'payment_method_code',
                'payment_method_name',
                'payment_instruction',
                'shipping_address',
                'shipping_phone',
                'shipping_postal_code',
            ]);
        });
    }
};
