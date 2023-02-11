<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use App\Traits\ApiResponse;

class GeoRequest extends FormRequest
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
            'name' => 'required|string',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = $this->error('Data failed!', 200, $validator->errors());

        throw new ValidationException($validator, $response);
    }
}
