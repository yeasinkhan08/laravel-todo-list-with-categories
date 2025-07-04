<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Todo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a test user
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        // Create some categories
        $categories = [
            ['name' => 'Work'],
            ['name' => 'Personal'],
            ['name' => 'Shopping'],
        ];

        foreach ($categories as $category) {
            $user->categories()->create($category);
        }

        // Create some todos
        $todos = [
            [
                'title' => 'Complete project',
                'description' => 'Finish the todo list project',
                'is_completed' => false,
                'category_id' => 1,
            ],
            [
                'title' => 'Buy groceries',
                'description' => 'Milk, eggs, bread',
                'is_completed' => false,
                'category_id' => 3,
            ],
            [
                'title' => 'Call mom',
                'description' => 'Wish her happy birthday',
                'is_completed' => true,
                'category_id' => 2,
            ],
        ];

        foreach ($todos as $todo) {
            $user->todos()->create($todo);
        }
    }
}
