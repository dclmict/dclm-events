<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use App\Traits\ApiResponse;

class RegistrationDataRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    use ApiResponse;

    public function authorize()
    {
        return true;
    }

    /**
     *
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required|string|in:Male,Female',
            'email' => 'required|string|email',
            // 'email_confirmation' => 'confirmed',
            'phone' => 'nullable|numeric',
            'whatsapp' => 'nullable|numeric',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'country_id' => 'required|exists:countries,iso2',
            'program_id' => 'required|'

            // 'age' => 'required|string',
            // 'facebook_username' => 'nullable|string',
            // 'location_church' => 'nullable|string',
            // 'new_comer' => 'required|string|in:Yes,No',
            // 'church' => 'nullable|string',
            // 'church_member' => 'required|string|in:Yes,No',
            // 'bus_stop' => 'required|string',
            // 'region_id' => 'nullable|integer',
            // 'group_id' => 'nullable|integer',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'program_id.required'  => 'You are required to select a program',
            '*.email'  => 'The :attribute required valid email address',
            '*.required'  => 'The :attribute field is required',
            '*.numeric'  => 'The :attribute field should be number',
            '*.string'  => 'The :attribute field required valid input',
            '*.in'  => 'The :attribute field required valid input',
            '*.in'  => 'The :attribute field required valid input',
            '*.exists'  => 'The :attribute field required valid input',

        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = $this->error('Registration failed!', 200, $validator->errors());

        throw new ValidationException($validator, $response);
    }
}
