<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderPaymentProofRequest extends FormRequest
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
            'payment_proof' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'payment_proof.required' => 'Bukti transfer wajib diunggah.',
            'payment_proof.image' => 'Bukti transfer harus berupa gambar.',
            'payment_proof.mimes' => 'Format bukti transfer harus jpg, jpeg, png, atau webp.',
            'payment_proof.max' => 'Ukuran bukti transfer maksimal 3MB.',
        ];
    }
}
