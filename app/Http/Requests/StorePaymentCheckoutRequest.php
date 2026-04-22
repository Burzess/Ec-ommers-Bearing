<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePaymentCheckoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'shipping_city_id' => [
                'required',
                Rule::exists('shipping_cities', 'id')->where(function ($query) {
                    $query->where('is_active', true);
                }),
            ],
            'payment_method' => [
                'required',
                'string',
                Rule::exists('payment_methods', 'code')->where(function ($query) {
                    $query->where('is_active', true);
                }),
            ],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'shipping_city_id.required' => 'Kota pengiriman wajib dipilih.',
            'shipping_city_id.exists' => 'Kota pengiriman tidak tersedia.',
            'payment_method.required' => 'Metode pembayaran wajib dipilih.',
            'payment_method.exists' => 'Metode pembayaran tidak tersedia.',
        ];
    }
}
