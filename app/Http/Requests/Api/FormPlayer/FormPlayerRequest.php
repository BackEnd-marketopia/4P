<?php

namespace App\Http\Requests\Api\FormPlayer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Response;
use Illuminate\Contracts\Validation\Validator;

class FormPlayerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param Validator $validator
     * @throws HttpResponseException
     */
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            Response::api($validator->errors()->first(), 400, false, 400)
        );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'                 => 'required|string|max:255',
            'phone'                => 'required|string|max:15',
            'age'                  => 'required|integer|min:0',
            'name_of_old_club'     => 'nullable|string|max:255',
            'name_of_current_club' => 'nullable|string|max:255',
            'job_of_parent'        => 'nullable|string|max:255',
            'long_life_desises'    => 'nullable|string|max:255',
            'injuries'             => 'nullable|string|max:255',
            'images'               => 'nullable',
            'city_name'            => 'required|string|max:255',
        ];
    }
}
