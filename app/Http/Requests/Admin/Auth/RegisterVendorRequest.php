<?php

namespace App\Http\Requests\Admin\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

/**
 * @property string $email
 * @property string $password
 * @property string $name
 * @property string $phone
 * @property UploadedFile $image
 * @property string $city_ids
 * @property string $name_of_brand
 * @property UploadedFile $logo
 * @property UploadedFile $cover
 * @property string $description
 * @property string $whatsapp
 * @property string $facebook
 * @property string $instagram
 * @property string $address
 * @property string $google_map_link
 * @property string $category_id
 */

class RegisterVendorRequest extends FormRequest
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
            'password' => 'required | min:8 | regex:/[A-Za-z]/ | regex:/[0-9]/ | confirmed',
            'image'    => 'nullable',
            'name_of_brand' => 'required | max:255',
            'logo' => 'required',
            'cover' => 'required',
            'description' => 'required',
            'whatsapp' => 'nullable',
            'facebook' => 'nullable',
            'instagram' => 'nullable',
            'address' => 'required',
            'google_map_link' => 'nullable',
            'city_ids' => 'required',
            'category_id' => 'required',
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
