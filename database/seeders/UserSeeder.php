<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // satic user
        User::create([
            'name' => 'Yeasin Khan',
            'email' => 'yeasin@example.com',
            'password' => 'yeasin',
        ]);
       
    }
}
