<?php

namespace App\Http\Requests\Product;

use App\Enums\ProductStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
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
            'status' => ['required', Rule::enum(ProductStatus::class)],
            'image' => ['nullable']
        ];
    }
}
