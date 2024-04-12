<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $user = User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // Hash the password
        ]);

        $user->assignRole('user'); // Assign role to the user
    }
}
