<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreTripRequest extends FormRequest
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
            'departure_city_id' => ['required',
                                    'integer',
                                    'exists:cities,id'],

            'destination_city_id' => ['required',
                                      'integer',
                                      'exists:cities,id',
                                      'different:departure_city_id'],

            'departure_time' => ['required',
                                'date_format:Y-m-d H:i:s',
                                'after:now'],

            'total_seats' => ['required',
                            'integer',
                            'min:1',
                            'max:255'],

            'price' => ['required',
                        'integer',
                        'min:1'],

            'discount_id' => ['nullable',
                            'integer',
                            'exists:discounts,id'],
        ];
    }

    public function attributes(): array
    {
        return [
            'departure_city_id'   => 'departure city',
            'destination_city_id' => 'destination city',
            'departure_time'      => 'departure time',
            'total_seats'         => 'total seats count',
            'price'               => 'price',
            'discount_id'         => 'discount',
        ];
    }

    public function messages(): array{
        return [
            'destination_city_id.different' => 'The destination city cannot be the same as the departure city.',
            'departure_time.after'          => 'The departure time must be a date in the future.',
        ];
    }
}
