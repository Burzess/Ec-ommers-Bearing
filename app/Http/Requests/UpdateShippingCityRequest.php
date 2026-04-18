<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateShippingCityRequest extends FormRequest
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
        $shippingCityId = $this->route('shipping_city')?->id;

        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('shipping_cities', 'name')->ignore($shippingCityId)],
            'shipping_cost' => ['required', 'numeric', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }
}
