<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('users')
            ->where(function ($query): void {
                $query->whereNull('role')->orWhere('role', 'user');
            })
            ->update(['role' => 'buyer']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('users')
            ->where('role', 'buyer')
            ->update(['role' => 'user']);
    }
};
