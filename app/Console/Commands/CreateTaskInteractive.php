<?php

namespace App\Console\Commands;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Console\Command;
use App\Events\TaskCreated;

class CreateTaskInteractive extends Command
{
    protected $signature = 'tasks:create-interactive';

    protected $description = 'Create a task interactively';

    public function handle(): int
    {
        $title = $this->ask('Enter task title');
        $description = $this->ask('Enter task description');
        $projectId = $this->ask('Enter project ID');
        $dueDate = $this->ask('Enter deadline (YYYY-MM-DD), or leave empty');
        $assignedTo = $this->ask('Enter assignee user ID, or leave empty');

        $status = $this->choice(
            'Choose task status',
            ['new', 'in_progress', 'done'],
            0
        );

        $project = Project::find($projectId);

        if (!$project) {
            $this->warn('Project not found. Task was not created.');

            return self::FAILURE;
        }

        if (!$this->confirm('Do you want to save this task?')) {
            $this->warn('Task creation cancelled.');

            return self::SUCCESS;
        }

        $task = Task::create([
            'title' => $title,
            'description' => $description,
            'status' => $status,
            'project_id' => $project->id,
            'author_id' => $project->user_id,
            'assigned_to' => $assignedTo ?: null,
            'due_date' => $dueDate ?: null,
        ]);

        TaskCreated::dispatch($task);

        $this->info("Task successfully created! ID: {$task->id}");

        return self::SUCCESS;
    }
}
