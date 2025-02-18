<?php

namespace App\Http\Requests\Provider\Attachment;

use Illuminate\Foundation\Http\FormRequest;

class StoreAttcahmentRequest extends FormRequest
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
            'name' => 'required|max:255',
            'type' => 'required|in:video,audio,pdf',
            'file' => 'required|mimes:mp4,mov,avi,mkv,mp3,wav,m4a,pdf',
            'sort_order' => 'required|integer',
            'lesson_id' => 'required|exists:lessons,id',
        ];
    }
}
