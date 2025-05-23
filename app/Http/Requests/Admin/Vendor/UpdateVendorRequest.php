<?php

namespace App\Http\Requests\Admin\Vendor;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVendorRequest extends FormRequest
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
        $id = $this->route('vendor');
        return [
            'name'     => 'required | max:255',
            'email'    => 'required | email | unique:users,email,' . $id,
            'phone'    => 'required | digits:11 | regex:/^01\d{9}$/ | unique:users,phone,' . $id,
            'password' => 'nullable | min:8 | regex:/[A-Za-z]/ | regex:/[0-9]/ | confirmed',
            'image'    => 'nullable',
            'name_of_brand' => 'required | max:255',
            'logo' => 'nullable',
            'cover' => 'nullable',
            'description' => 'required',
            'whatsapp' => 'nullable',
            'facebook' => 'nullable',
            'instagram' => 'nullable',
            'address' => 'required',
            'google_map_link' => 'nullable',
            'city_ids' => 'required',
            'category_id' => 'required',
            'status' => 'required|in:accepted,pending,rejected',
            'status_of_account' => 'required | in:active,inactive',
        ];
    }
}
