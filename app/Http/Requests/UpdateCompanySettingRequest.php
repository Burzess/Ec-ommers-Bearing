<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanySettingRequest extends FormRequest
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
            'company_name' => ['required', 'string', 'max:255'],
            'company_address' => ['required', 'string', 'max:1000'],
            'company_phone' => ['required', 'string', 'max:30'],
            'company_email' => ['required', 'string', 'email', 'max:255'],
            'business_days' => ['nullable', 'string', 'max:120'],
            'business_hours' => ['nullable', 'string', 'max:120'],
            'maps_embed_url' => ['nullable', 'url', 'max:2000'],
        ];
    }
}
