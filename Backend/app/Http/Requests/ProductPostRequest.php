<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductPostRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'productName' => 'nullable|string|max:255',
            'categoryName' => 'nullable|string|max:255',
            'supplierName' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'nullable|integer|min:0',
            'sellingPrice' => 'nullable|numeric|min:0',
            'comparePrice' => 'nullable|numeric|min:0',
            'capitalPrice' => 'nullable|numeric|min:0',
            'sku' => 'nullable|string|max:255|unique:products,sku',
            'barcode' => 'nullable|string|max:255|unique:products,barcode',
            'allowOrders' => 'nullable|boolean',
        ];

    }

    public function attributes()
    {
        return [
            'productName' => 'Product Name',
            'categoryName' => 'Category Name',
            'supplierName' => 'Supplier Name',
            'description' => 'Description',
            'quantity' => 'Quantity',
            'sellingPrice' => 'Selling Price',
            'comparePrice' => 'Compare Price',
            'capitalPrice' => 'Capital Price',
            'sku' => 'SKU',
            'barcode' => 'Barcode',
            'allowOrders' => 'Allow Orders',
        ];
    }

}
