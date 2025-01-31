<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sportCategory = [
            [
                'name_arabic' => 'رياضات',
                'name_english' => 'Sports',
                'image' => 'https://via.placeholder.com/150',
                'sort_order' => 1,
                'is_sport' => 1,
            ]
        ];
        Category::insert($sportCategory);
    }
}
