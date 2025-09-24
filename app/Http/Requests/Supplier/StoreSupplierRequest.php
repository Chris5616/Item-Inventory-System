<?php

namespace App\Http\Requests\Supplier;

use Illuminate\Foundation\Http\FormRequest;

class StoreSupplierRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
          'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'name' => 'required|string|max:50',
            'email' => 'required|email|max:50|unique:suppliers,email',
            'phone' => 'required|string|max:25|unique:suppliers,phone',
            'shop_name' => 'required|string|max:50',
            'type' => 'required|string|max:25',
            'account_number' => 'string|max:25',
            'address' => 'required|string|max:100',
        ];
    }
}
