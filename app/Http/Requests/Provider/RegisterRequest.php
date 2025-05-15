<?php

namespace App\Http\Requests\Provider;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

/**
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $password
 * @property UploadedFile $image
 * @property string $city_id
 * @property string $name_of_school_arabic
 * @property string $name_of_school_english
 * @property UploadedFile $logo
 * @property array $educational_department_id
 * @property string|null $address
 * @property string|null $whatsapp
 * @property string|null $facebook
 * @property string|null $instagram
 *
 */
class RegisterRequest extends FormRequest
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
            'name'     => 'required | max:255',
            'email'    => 'required | email | unique:users,email',
            'phone'    => 'required | digits:11 | regex:/^01\d{9}$/ | unique:users,phone',
            'image'    => 'nullable',
            'password' => 'required | min:8 | regex:/[A-Za-z]/ | regex:/[0-9]/ | confirmed',
            'name_of_school_arabic' => 'required | max:255',
            'name_of_school_english' => 'required | max:255',
            'logo' => 'required',
            'educational_department_id' => 'required | exists:education_departments,id',
            'address' => 'nullable',
            'whatsapp' => 'nullable',
            'facebook' => 'nullable',
            'instagram' => 'nullable',
        ];
    }
}
