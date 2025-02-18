<?php

namespace App\Http\Requests\Provider\Unit;

use Illuminate\Foundation\Http\FormRequest;

class StoreUnitRequest extends FormRequest
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
            'name_arabic' => 'required|max:255',
            'name_english' => 'required|max:255',
            'description' => 'required|string',
            'image' => 'required',
            'sort_order' => 'required|integer|min:0',
            'class_room_id' => 'required|exists:class_rooms,id',
        ];
    }
}
