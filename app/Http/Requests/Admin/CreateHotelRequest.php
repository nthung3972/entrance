<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateHotelRequest extends FormRequest
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
            'prefecture_id' => [
                'required',
                'exists:prefectures,prefecture_id',
            ],
            'hotel_name' => [
                'required',
                'max:225',
            ],
            'images' => [
                'max:5120',
                'mimes:jpeg,jpg,png',
            ],
        ];
    }
}
