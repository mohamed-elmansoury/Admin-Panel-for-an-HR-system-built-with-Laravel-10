<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OccasionRequest extends FormRequest
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
            'name' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
            'days_counter' => 'required',
            
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'حقل نوع الشفت مطلوب',
            'from_date.required' => 'حقل يبدا من الساعه مطلوب',
            'to_date.required' => 'حقل ينتهي  الساعه مطلوب',
            'days_counter.required' => 'حقل عدد الساعات مطلوب',
            

        ];
    }
}
