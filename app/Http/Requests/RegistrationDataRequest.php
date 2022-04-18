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
            'fullname' => 'required|string',
            'email' => 'nullable|string|email',
            'gender' => 'required|string|in:Male,Female',
            'phone_number' => 'required|numeric',
            'whatsapp_number' => 'nullable|numeric',
            'program_id' => 'required|integer',
            'country_id' => 'required|integer',
            'state' => 'nullable|string',
            
            // 'address' => 'required|string',
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

    protected function failedValidation(Validator $validator)
    {
        $response = $this->error('Registration failed!', 200, $validator->errors());

        throw new ValidationException($validator, $response);
    }
}
