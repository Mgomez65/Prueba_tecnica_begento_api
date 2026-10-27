<?php

namespace App\Http\Requests\Product;

use Illuminate\Contracts\Validation\ValidationRule;
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

    protected function prepareForValidation(): void
    {
        \Log::info('PRODUCT REQUEST', $this->all());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [    
            'name' => [
                'sometimes',
                'required',
                'string',
                'max:255'
            ],
            'description' => [
                'required',
                'string'
            ],
            'price' => [
                'required',
                'numeric',
                'min:0',
                'decimal:0,2'

            ],
            'tax_cost' => [
                'required',
                'numeric',
                'min:0'
            ],
            'manufacturing_cost' => [
                'required',
                'numeric',
                'min:0',
                'decimal:0,2'
            ],
            'currency_id' => [
                'required',
                'decimal:0,2',
                'exists:currencies,id'
            ]  
        ];
    }
    
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre del producto es obligatorio.',
            'name.string' => 'El nombre debe ser un texto.',
            'name.max' => 'El nombre no puede superar los 255 caracteres.',

            'description.string' => 'La descripción debe ser un texto.',
            'description.required' => 'La descripción es obligatoria.',

            'price.required' => 'El precio es obligatorio.',
            'price.numeric' => 'El precio debe ser un número.',
            'price.min' => 'El precio no puede ser negativo.',
            'price.decimal' => 'El precio puede tener hasta 2 decimales.',

            'tax_cost.numeric' => 'El costo de impuestos debe ser un número.',
            'tax_cost.min' => 'El costo de impuestos no puede ser negativo.',
            'tax_cost.required' => 'El costo de impuestos es obligatorio.',

            'manufacturing_cost.numeric' => 'El costo de fabricación debe ser un número.',
            'manufacturing_cost.min' => 'El costo de fabricación no puede ser negativo.',
            'manufacturing_cost.decimal' => 'El costo de fabricación puede tener hasta 2 decimales.',
            'manufacturing_cost.required' => 'El costo de fabricación es obligatorio.',

            'currency_id.required' => 'Debés seleccionar una moneda.',
            'currency_id.exists' => 'La moneda seleccionada no existe.',
        ];
    }

}