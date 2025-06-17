<?php

namespace Database\Seeders;

use App\Models\DepartmentType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DepartmentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category_types = [
            ['name' => 'Faculties'],
            ['name' => 'Communities'],
            ['name' => 'Clubs'],
        ];

        foreach($category_types as $data) {
            DepartmentType::create($data);
        }
    }
}
