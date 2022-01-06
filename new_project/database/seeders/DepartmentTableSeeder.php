<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = [
            [
                'name' => 'CS',
            ],
         
        ];

        foreach ($departments as $department) {
            $d = Department::create([
                'name' => $department['name'],
            ]);
        }
    }
}
