<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

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
