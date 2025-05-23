<?php

namespace App\Http\Requests\Provider\Lesson;

use Illuminate\Foundation\Http\FormRequest;

class StoreLessonRequest extends FormRequest
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
            'name'        => 'required|max:255',
            'description' => 'required',
            'image'       => 'required',
            'sort_order'  => 'required|integer|min:0',
            'unit_id'     => 'required|exists:units,id',
        ];
    }
}
