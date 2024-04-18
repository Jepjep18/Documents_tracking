<?php

namespace Database\Seeders;

use App\Models\Department;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $departments = [
            'ADMIN',
            'TOD',
            'ILCDB',
            'IBPLS',
            'FWP',
            'PNPKI',
            'IIDB',
            'GECS',
            'CYBER',
            'SUPPLY',
            'CASHIER',
            'BUDGET',
            'MOTORPOOL',
        ];

        foreach ($departments as $department) {
            Department::create(['name' => $department]);
        }
    }
}
