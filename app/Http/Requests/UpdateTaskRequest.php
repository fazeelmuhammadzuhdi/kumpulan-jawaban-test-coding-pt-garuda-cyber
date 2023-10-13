<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'gambar' => 'required|image|mimes:jpg,png,jpeg',
        ];
    }

    public function messages(): array
    {
        return [
            'gambar.required' => ':attribute Wajib Diisi',
            'gambar.mimes' => ':attribute Wajib JPG,PNG Atau PNG',
        ];
    }

    public function attributes(): array
    {
        return [
            'gambar' => 'Gambar',
        ];
    }
}
