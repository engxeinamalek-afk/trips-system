<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDiscountRequest extends FormRequest
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
            'regular_percentage' => ["sometimes",
                                    'numeric',
                                    'min:0',
                                    'max:100'],
            'vip_percentage' => ["sometimes",
                                    'numeric',
                                    'min:0',
                                    'max:100']
        ];
    }

    public function attributes(): array{
        return [
            'regular_percentage' => "regular percentage",
            'vip_percentage' => 'vip percentage'
        ];
    }
}
