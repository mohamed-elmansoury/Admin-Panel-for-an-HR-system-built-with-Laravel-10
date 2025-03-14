<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentsRequest extends FormRequest
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
        'name'=>'required|unique:Department',
        'phone'=>'required' ,
       
        'active'=>'required'
        ];
    }
    public function massage(): array
    {
        return [
            'name'=>'الاسم مطلوب',
            'name.unique'=>'الاسم موجود من قبل',
            'phone'=>'الهاتف مطلوب' ,
           
            'active'=>'required'
            ];
    }
}
