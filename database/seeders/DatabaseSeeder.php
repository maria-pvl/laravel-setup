<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::factory(3)->create();

        foreach ($users as $user) {
            $projects = Project::factory(2)->create([
                'user_id' => $user->id
            ]);

            foreach ($projects as $project) {
                $tasks = Task::factory(5)->create([
                    'project_id' => $project->id,
                    'author_id' => $user->id,
                    'assigned_to' => $users
                        ->where('id', '!=', $user->id)
                        ->random()->id
                ]);

                foreach ($tasks as $task) {
                    $commentUsers = $users->shuffle()->take(rand(2, 3));

                    foreach ($commentUsers as $commentUser) {
                        Comment::factory()->create([
                            'task_id' => $task->id,
                            'user_id' => $commentUser->id
                        ]);
                    }
                }
            }
        }
    }
}