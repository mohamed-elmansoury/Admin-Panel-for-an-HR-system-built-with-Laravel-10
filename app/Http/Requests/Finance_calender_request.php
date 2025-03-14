<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Finance_calender_request extends FormRequest
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
        'FINANCE_YR'=>'required|unique:finance_calenders',
        'FINANCE_YR_DESC'=>'required' ,
        'start_date'=>'required',
        'end_date'=>'required'
        ];
    }
    public function massage(): array
    {
        return [
        'FINANCE_YR'=>'كود السنه الماليه مطلوب',
        'FINANCE_YR.unique'=>'كود السنه الماليه مكرر',
        'FINANCE_YR_DESC'=>'وصف السنة المالية مطلوب' ,
        'start_date'=>'تاريخ بدايه السنه مطلوب ',
        'end_date'=>'تاريخ نهايه السنه مطلوب'
        ];
    }
}
