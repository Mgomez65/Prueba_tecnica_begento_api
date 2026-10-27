<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'sometimes',
                'required',
                'string',
                'max:255',
            ],
            'description' => [
                'sometimes',
                'required',
                'string',
            ],
            'price' => [
                'sometimes',
                'required',
                'numeric',
                'decimal:0,2',
                'min:0',
            ],
            'tax_cost' => [
                'sometimes',
                'required',
                'numeric',
                'decimal:0,2',
                'min:0',
            ],
            'manufacturing_cost' => [
                'sometimes',
                'required',
                'numeric',
                'decimal:0,2',
                'min:0',
            ],
            'currency_id' => [
                'sometimes',
                'required',
                'integer',
                'exists:currencies,id',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre del producto es obligatorio.',
            'name.string' => 'El nombre debe ser un texto.',
            'name.max' => 'El nombre no puede superar los 255 caracteres.',

            'description.required' => 'La descripción del producto es obligatoria.',
            'description.string' => 'La descripción debe ser un texto.',

            'price.required' => 'El precio del producto es obligatorio.',
            'price.numeric' => 'El precio debe ser un número.',
            'price.decimal' => 'El precio puede tener hasta 2 decimales.',
            'price.min' => 'El precio no puede ser negativo.',

            'tax_cost.required' => 'El costo de impuestos es obligatorio.',
            'tax_cost.numeric' => 'El costo de impuestos debe ser un número.',
            'tax_cost.decimal' => 'El costo de impuestos puede tener hasta 2 decimales.',
            'tax_cost.min' => 'El costo de impuestos no puede ser negativo.',

            'manufacturing_cost.required' => 'El costo de fabricación es obligatorio.',
            'manufacturing_cost.numeric' => 'El costo de fabricación debe ser un número.',
            'manufacturing_cost.decimal' => 'El costo de fabricación puede tener hasta 2 decimales.',
            'manufacturing_cost.min' => 'El costo de fabricación no puede ser negativo.',

            'currency_id.required' => 'Debés seleccionar una moneda.',
            'currency_id.integer' => 'El identificador de la moneda debe ser un número entero.',
            'currency_id.exists' => 'La moneda seleccionada no existe.',
        ];
    }
}
