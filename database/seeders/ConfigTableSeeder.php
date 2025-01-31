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
            ]
        ];
        Config::insert($config);
    }
}
