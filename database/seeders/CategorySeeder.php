<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        
        $categories = [
            'Work',
            'Personal',
            'Shopping',
            'Health',
            'Education'
        ];

        foreach ($users as $user) {
            foreach ($categories as $categoryName) {
                Category::create([
                    'name' => $categoryName,
                    'user_id' => $user->id
                ]);
            }
        }
    }
}
