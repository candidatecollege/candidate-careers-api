<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class CareerRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'divisionID' => 'required',
            'departmentID' => 'required',
            'positionID' => 'required',
            'name' => 'required',
            'type' => 'nullable',
            'is_urgently_needed' => 'required',
            'responsibilities' => 'required',
            'skill_qualifications' => 'required',
            'benefits' => 'required',
            'descriptions' => 'required'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status' => Response::HTTP_BAD_REQUEST,
                'message' => 'Validation Errors',
                'error' => $validator->errors(),
            ])
        );
    }
}
