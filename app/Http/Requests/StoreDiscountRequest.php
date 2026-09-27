<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreDiscountRequest extends FormRequest
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
            "name" => ['required',
                        'string',
                        'min:2',
                        'max:50'],
            'regular_percentage' => ["required",
                                    'numeric',
                                    'min:0',
                                    'max:100'],
            'vip_percentage' => ["required",
                                    'numeric',
                                    'min:0',
                                    'max:100']
        ];
    }

    public function attributes():array{
        return [
            'name' => 'discount name',
            'regular_percentage' => "regular percentage",
            'vip_percentage' => "vip percentage"
        ];
    }
}
