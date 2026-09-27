<?php

namespace App\Http\Requests;

use App\Enums\BookingType;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class StoreBookingRequest extends FormRequest
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
            'trip_id' => ['required', 'integer', 'exists:trips,id'],
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_phone' => ['required', 'string', 'regex:/^[0-9\+\-\(\)\s]{7,20}$/'],
            'type' => ['required', Rule::enum(BookingType::class)],
            'seats_count' => ['required', 'integer', 'min:1', 'max:50']
        ];
    }

    public function attributes(): array{
        return [
            'trip_id'        => 'trip id',
            'customer_name'  => 'name',
            'customer_phone' => 'phone',
            'type'           => 'type',
            'seats_count'    => 'seats count'
        ];
    }
}
