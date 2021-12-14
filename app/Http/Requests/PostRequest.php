<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'start_datetime' => 'required_with:end_datetime|after_or_equal:now',
            'end_datetime' => 'required_with:start_datetime|after_or_equal:start_datetime',
            'current_location' => 'required|string|max:100',
            'asking' => 'string|max:500',
            'car_model' => 'required|string|max:30',
            'max_passengers' => 'required|numeric|between:1,10',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
        ];
    }
    
    public function messages()
    {
        return [
            'start_datetime.required_with' => '開始日時と終了日時はセットで入力してください。',
            'start_datetime.after_or_equal' => '開始日時は現在時刻以降にしてください。',
            'end_datetime.required_with' => '開始日時と終了日時はセットで入力してください。',
            'end_datetime.after_or_equal' => '終了日時は開始時刻以降にしてください。',
            'current_location.required' => '現在地は必ず入力してください。',
            'car_model.required' => '車種は必ず入力してください。',
            'max_passengers.required' => '相乗り可能人数は必ず入力してください。',
            'max_passengers.between' => '相乗り可能人数は１～１０の間で入力してください。',
            'lat.required' => '現在地が取得できませんでした。もう一度入力してください。',
            'lng.required' => '現在地が取得できませんでした。もう一度入力してください。',
            
        ];
    }
}