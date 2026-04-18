<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ShippingCity extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'shipping_cost',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'shipping_cost' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
