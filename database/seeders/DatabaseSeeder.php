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

        \App\Models\User::factory()->create([
            'first_name' => 'dani',
            'last_name' => 'ramli',
            'phone_number' => '085',
            'email' => 'dani@gmail.com',
            'password' => bcrypt('12345')
        ]);
    }
}
