<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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
            'name'     => 'required | string | max:255',
            'email'    => 'nullable | email | unique:users,email',
            'phone'    => 'required | digits:11 | regex:/^01\d{9}$/ | unique:users,phone',
            'image'    => 'nullable',
            'password' => 'required | confirmed | min:8 | regex:/[A-Za-z]/ | regex:/[0-9]/',
            'city_id'  => 'required | exists:cities,id',
            'one_year'  => 'nullable',
            'start_date' => [
                'nullable',
                'date',
                Rule::requiredIf(fn() => request()->filled('end_date') && request()->missing('one_year'))
            ],
            'end_date' => [
                'nullable',
                'date',
                Rule::requiredIf(fn() => request()->filled('start_date') && request()->missing('one_year')),
                'after_or_equal:start_date'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'phone.regex'    => __('message.The phone number must start with 01 and contain exactly 11 digits'),
            'password.regex' => __('message.The password must contain at least one letter and at least one number'),
        ];
    }
}
