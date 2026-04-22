<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ReviewTransferProofRequest extends FormRequest
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
            'action' => ['required', Rule::in(['verify', 'reject'])],
            'note' => ['nullable', 'string', 'max:1000', 'required_if:action,reject'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'action.required' => 'Aksi verifikasi wajib dipilih.',
            'action.in' => 'Aksi verifikasi tidak valid.',
            'note.required_if' => 'Catatan penolakan wajib diisi saat menolak bukti transfer.',
            'note.max' => 'Catatan maksimal 1000 karakter.',
        ];
    }
}
