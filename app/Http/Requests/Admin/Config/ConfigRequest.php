<?php

namespace App\Http\Requests\Admin\Config;

use Illuminate\Foundation\Http\FormRequest;

class ConfigRequest extends FormRequest
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
            'android_version'               => 'required |integer',
            'ios_version'                   => 'required | integer',
            'android_url'                   => 'required',
            'ios_url'                       => 'required',
            'terms_and_conditions'          => 'required',
            'about_us'                      => 'required',
            'privacy_policy'                => 'required',
            'image_of_card'                 => 'nullable',
            'price_of_card'                 => 'required|numeric',
            'description_of_card_arabic'    => 'required',
            'description_of_card_english'   => 'required',
            'facebook_link'                 => 'nullable',
            'twitter_link'                  => 'nullable',
            'instagram_link'                => 'nullable',
            'youtube_link'                  => 'nullable',
            'snapchat_link'                 => 'nullable',
            'tiktok_link'                   => 'nullable',
            'whatsapp_link'                 => 'nullable',
            'linkedin_link'                 => 'nullable',
            'telegram_link'                 => 'nullable',
            'website_link'                  => 'nullable',

        ];
    }
}
