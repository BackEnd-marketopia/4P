<?php

namespace App\Http\Requests\Admin\Provider;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Provider;

class UpdateProviderRequest extends FormRequest
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
        $id = $this->route('provider');
        $userId = Provider::where('id', $id)->value('user_id');

        return [
            'name'     => 'required | max:255',
            'email'    => 'required | email | unique:users,email,' . $userId,
            'phone'    => 'required | digits:11 | regex:/^01\d{9}$/ | unique:users,phone,' . $userId,
            'password' => 'nullable | min:8 | regex:/[A-Za-z]/ | regex:/[0-9]/ | confirmed',
            'image'    => 'nullable',
            'name_of_school_arabic' => 'required | max:255',
            'name_of_school_english' => 'required | max:255',
            'logo' => 'nullable',
            'educational_department_id' => 'required|array',
            'educational_department_id.*' => 'exists:education_departments,id',
            'whatsapp' => 'nullable',
            'facebook' => 'nullable',
            'instagram' => 'nullable',
            'address' => 'required',
            'provider_status' => 'required|in:accepted,pending,rejected',
            'account_status' => 'required|in:active,inactive',
        ];
    }
}
