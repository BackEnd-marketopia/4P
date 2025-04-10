<?php

namespace Database\Seeders;

use App\Models\EducationDepartment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EducationDepartmentTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $education_department = [
            [
                'name_arabic'  => 'مصري',
                'name_english' => 'Egyptian',
            ],
            [
                'name_arabic'  => 'سوداني',
                'name_english' => 'Sudanese',
            ],
            [
                'name_arabic'  => 'أكسفورد',
                'name_english' => 'Oxford',
            ]
        ];
        EducationDepartment::insert($education_department);
    }
}
