<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'is_admin' => true,
            'first_name' => 'admin',
            'last_name' => 'karsa',
            'phone_number' => '0',
            'email' => 'admin@gmail.com',
            'team_name' => 'admin',
            'password' => bcrypt('123456')
        ]);
    }
}
