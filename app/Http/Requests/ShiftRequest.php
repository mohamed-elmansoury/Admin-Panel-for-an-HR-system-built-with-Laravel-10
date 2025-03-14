<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShiftRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => 'required',
            'from_time' => 'required',
            'to_time' => 'required',
            'total_hour' => 'required',
            'active' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'type.required' => 'حقل نوع الشفت مطلوب',
            'from_time.required' => 'حقل يبدا من الساعه مطلوب',
            'to_time.required' => 'حقل ينتهي  الساعه مطلوب',
            'total_hour.required' => 'حقل عدد الساعات مطلوب',
            'active.required' => 'حقل حالة التفعيل مطلوب',

        ];
    }
}
