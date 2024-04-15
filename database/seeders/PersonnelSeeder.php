<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PersonnelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $user = User::create([
            'name' => 'personnel',
            'email' => 'personnel@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // Hash the password
        ]);

        $user->assignRole('personnel'); // Assign role to the user
    }
}
