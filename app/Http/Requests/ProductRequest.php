<?php

// app/Http/Requests/ProductRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Allow all users (modify if needed)
    }

    public function rules(): array
    {
        return [
            'name'           => 'required|string|max:255',
            'purchase_price' => 'required|numeric|min:0',
            'sell_price'     => 'required|numeric|min:0',
            'opening_stock'  => 'required|integer|min:0',
        ];
    }
}
