<?php

namespace Database\Seeders;

use App\Models\Config;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfigTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $config = [
            [
                "id" => 1,
                "terms_and_conditions" => "test",
                "about_us" => "test",
                "privacy_policy" => "test",
                "android_version" => 1,
                "ios_version" => 1,
                "android_url" => "www.google.com",
                "ios_url" => "www.google.com",
                'image_of_card' => 'test.jpg',
                'price_of_card' => 100,
                'description_of_card_arabic' => 'تجربه',
                'description_of_card_english' => 'test',
                'facebook_link' => 'https://www.facebook.com',
                'twitter_link' => 'https://www.twitter.com',
                'instagram_link' => 'https://www.instagram.com',
                'youtube_link' => 'https://www.youtube.com',
                'snapchat_link' => 'https://www.snapchat.com',
                'tiktok_link' => 'https://www.tiktok.com',
                'whatsapp_link' => 'https://www.whatsapp.com',
                'linkedin_link' => 'https://www.linkedin.com',
                'telegram_link' => 'https://www.telegram.com',
                'website_link' => 'https://www.website.com',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];
        Config::insert($config);
    }
}
