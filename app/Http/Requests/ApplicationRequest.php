<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class ApplicationRequest extends FormRequest
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
            'email' => 'required',
            'full_name' => 'required',
            'university' => 'required',
            'major' => 'required',
            'instagram' => 'required',
            'whatsapp' => 'required',
            'divisionID' => 'required',
            'departmentID' => 'required',
            'reason' => 'required',
            'leadership_experience' => 'required',
            'skill_experience' => 'required',
            'busyness' => 'required',
            'commitment_value' => 'required',
            'reason_commitment_value' => 'required',
            'cv' => 'required|mimes:pdf|max:5000',
            'portfolio' => 'required|mimes:pdf|max:5000',
            'is_available_for_unpaid' => 'required'
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
