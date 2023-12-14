<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class CreateRideRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'source'=>['required'],
            'source_lat'=>['required'],
            'source_long'=>['required'],
            'destination'=>['required'],
            'destination_lat'=>['required'],
            'destination_long'=>['required'],
        ];
    }
}
