<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
           "name" => ["required", "string", "max:50"],
           "description" => ["required", "string", "max:100"],
           "image" => ["required", "string"],
           "quantity" => ["required", "integer"],
           "price" => ["required", "integer"],
           "category_id" => ["required", "integer"]
        ];
    }
}
