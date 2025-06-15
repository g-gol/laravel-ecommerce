<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => ['required', 'min:3', 'max:255'],
            'excerpt' => ['required', 'min:20', 'max:2000'],
            'description' => ['required', 'min:20', 'max:10000'],
            'price' => ['required', 'numeric', 'min:1'],
            'image' => ['nullable', 'image', 'mimes:jpeg,jpg,png']
        ];
    }
}
