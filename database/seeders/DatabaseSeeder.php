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
        \App\Models\User::create([
            'is_admin' => false,
            'first_name' => 'jumrah',
            'last_name' => 'daeng',
            'phone_number' => '0',
            'email' => 'dgjumrah@gmail.com',
            'team_name' => 'jumrah team',
            'password' => bcrypt('123456')
        ]);
        
        \App\Models\User::create([
            'is_admin' => false,
            'first_name' => 'agung',
            'last_name' => 'faturohman',
            'phone_number' => '082393437052',
            'email' => 'faturagung07@gmail.com',
            'team_name' => 'Swadaya FC',
            'password' => bcrypt('123456')
        ]);
        \App\Models\User::create([
            'is_admin' => false,
            'first_name' => 'khaidir',
            'last_name' => 'ansyar',
            'phone_number' => '085396426641',
            'email' => 'didipengpeng@gmail.com',
            'team_name' => 'Peng Peng',
            'password' => bcrypt('123456')
        ]);
        \App\Models\User::create([
            'is_admin' => false,
            'first_name' => 'nur ilahi',
            'last_name' => 'syam',
            'phone_number' => '085212621205',
            'email' => 'nurilahi027@gmail.com',
            'team_name' => 'Peng Peng',
            'password' => bcrypt('123456')
        ]);
        \App\Models\User::create([
            'is_admin' => false,
            'first_name' => 'muh',
            'last_name' => 'rato',
            'phone_number' => '085343762181',
            'email' => 'blitzer10@gmail.com',
            'team_name' => 'Blitzer',
            'password' => bcrypt('123456')
        ]);
        \App\Models\User::create([
            'is_admin' => false,
            'first_name' => 'muh',
            'last_name' => 'awal',
            'phone_number' => '085343762181',
            'email' => 'awalvespa@gmail.com',
            'team_name' => 'SIBIJA',
            'password' => bcrypt('123456')
        ]);

        \App\Models\User::create([
            'is_admin' => false,
            'first_name' => 'dhani',
            'last_name' => 'ramli',
            'phone_number' => '0',
            'email' => 'lantidg5@gmail.com',
            'team_name' => 'Utah Team',
            'password' => bcrypt('123456')
        ]);
        \App\Models\User::create([
            'is_admin' => false,
            'first_name' => 'allu',
            'last_name' => 'tai',
            'phone_number' => '0',
            'email' => 'allutai427@gmail.com',
            'team_name' => 'Allu Team',
            'password' => bcrypt('123456')
        ]);
        \App\Models\User::create([
            'is_admin' => false,
            'first_name' => 'prakerja',
            'last_name' => '1',
            'phone_number' => '0',
            'email' => 'prakerjasatu964@gmail.com',
            'team_name' => 'prakerja Team',
            'password' => bcrypt('123456')
        ]);
    }
}
