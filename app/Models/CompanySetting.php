<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanySetting extends Model
{
    protected $fillable = [
        'company_name',
        'company_address',
        'company_phone',
        'company_email',
        'business_days',
        'business_hours',
        'maps_embed_url',
    ];

    public static function current(): self
    {
        return static::query()->firstOrCreate([], [
            'company_name' => 'Asian Bearindo Jaya',
            'company_address' => 'Jl. Tanjungsari no. 19, Sukomanunggal Surabaya, Jawa Timur',
            'company_phone' => '+62 812-3456-7890',
            'company_email' => 'admin@asianbearindo.com',
            'business_days' => 'Senin - Jumat',
            'business_hours' => '08.00 - 17.00',
            'maps_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15831.43723628913!2d112.67946124076845!3d-7.25684857497332!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7ff936876686d%3A0xa3fa7db480604775!2sPT.%20Asian%20Bearindo%20Jaya%20(HQ)!5e0!3m2!1sid!2sid!4v1775962861342!5m2!1sid!2sid',
        ]);
    }
}
