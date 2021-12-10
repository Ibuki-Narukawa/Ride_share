<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarpoolerRequest extends FormRequest
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
            'start_datetime' => 'required|after_or_equal:now',
            'from' => 'required|string|max:50',
            'to' => 'required|string|max:50',
        ];
    }
    
    public function messages()
    {
        return [
            'start_datetime.required' => '開始日時は必ず入力してください。',
            'start_datetime.after_or_equal' => '出発日時は現在時刻以降にしてください。',
            'from.required' => '出発地は必ず入力してください。',
            'to.required' => '目的地は必ず入力してください。',
        ];
    }
}
