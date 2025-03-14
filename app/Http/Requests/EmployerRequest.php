<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Change this as needed
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employers,email',
            'phone' => 'required|string|max:15',
            'address' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Max size 2MB
          
            'resignation_id' => 'nullable|exists:resignations,id',
            'religion_id' => 'required|exists:religions,id',
            'qualification_id' => 'required|exists:qualifications,id',
            'occasion_id' => 'nullable|exists:occasions,id',
            'nationality_id' => 'required|exists:nationalities,id',
            'branch_id' => 'required|exists:branches,id',
            'admin_id' => 'required|exists:admins,id',
            
        ];
    }

    /**
     * Custom error messages for validation.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The employer name is required.',
            'name.string' => 'The employer name must be a valid string.',
            'name.max' => 'The employer name may not be greater than 255 characters.',
            
            'email.required' => 'The employer email is required.',
            'email.email' => 'The email address must be valid.',
            'email.unique' => 'This email is already taken. Please use another one.',

            'phone.required' => 'The phone number is required.',
            'phone.string' => 'The phone number must be a valid string.',
            'phone.max' => 'The phone number may not be greater than 15 characters.',

            'address.string' => 'The address must be a valid string.',
            'address.max' => 'The address may not be greater than 255 characters.',

            'photo.image' => 'The photo must be an image file.',
            'photo.mimes' => 'The photo must be in one of the following formats: jpeg, png, jpg, gif.',
            'photo.max' => 'The photo may not be larger than 2MB.',

            

            'resignation_id.exists' => 'The selected resignation is invalid.',

            'religion_id.required' => 'The religion is required.',
            'religion_id.exists' => 'The selected religion is invalid.',

            'qualification_id.required' => 'The qualification is required.',
            'qualification_id.exists' => 'The selected qualification is invalid.',

            'occasion_id.exists' => 'The selected occasion is invalid.',

            'nationality_id.required' => 'The nationality is required.',
            'nationality_id.exists' => 'The selected nationality is invalid.',

            'branch_id.required' => 'The branch is required.',
            'branch_id.exists' => 'The selected branch is invalid.',

            'admin_id.required' => 'The admin is required.',
            'admin_id.exists' => 'The selected admin is invalid.',

               
        ];
    }
}
