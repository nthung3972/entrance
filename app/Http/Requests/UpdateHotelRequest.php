<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateHotelRequest extends FormRequest
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
                Rule::unique('hotels', 'hotel_name')->ignore($this->hotel_id, 'hotel_id'),
            ],
            'image' => [
                'image',
                'mimes:jpeg,png,jpg',
                'max:5120', 
            ],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'prefecture_id.required' => '都道府県を選択してください。',
            'prefecture_id.exists' => '選択された都道府県は存在しません。',
            'hotel_name.required' => 'ホテル名を入力してください。',
            'hotel_name.unique' => 'このホテル名はすでに使用されています。',
            'image.image' => 'アップロードされたファイルは画像でなければなりません。',
            'image.mimes' => '画像はjpeg、png、またはjpg形式でなければなりません。',
            'image.max' => '画像のサイズは2MB以下でなければなりません。',
        ];
    }
}
