<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Todo;
use Carbon\Carbon;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          $todos = [
            [
                'title' => 'Prepare Weekly Report',
                'description' => 'Collect data and prepare the weekly report for management.',
                'is_completed' => true,
                'category_id' => 1,
                'due_date' => Carbon::now()->addDays(1), 
                'user_id' => 1,
            ],
            [
                'title' => 'Client Follow-Up Emails',
                'description' => 'Send update emails and get feedback from clients.',
                'is_completed' => false,
                'category_id' => 2,
                'due_date' => Carbon::now()->addDays(2),
                'user_id' => 1,
            ],
            [
                'title' => 'Team Meeting Arrangement',
                'description' => 'Set up internal meeting and share agenda.',
                'is_completed' => false,
                'category_id' => 3,
                'due_date' => Carbon::now()->addDays(3),
                'user_id' => 1,
            ],
            [
                'title' => 'Inventory Check',
                'description' => 'Check office supplies and prepare restock list.',
                'is_completed' => false,
                'category_id' => 4,
                'due_date' => Carbon::now()->addDays(4),            
                'user_id' => 1,
            ],
            [
                'title' => 'Backup Important Files',
                'description' => 'Backup project files to cloud storage with structure.',
                'is_completed' => false,
                'category_id' => 5,
                'due_date' => Carbon::now()->addDays(5),
                'user_id' => 1,
            ],
        ];

        foreach ($todos as $todo) {
            Todo::create($todo);
        }
    }
}
