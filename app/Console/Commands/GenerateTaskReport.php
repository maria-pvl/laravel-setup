<?php

namespace App\Console\Commands;

use App\Models\Task;
use Illuminate\Console\Command;

class GenerateTaskReport extends Command
{
    protected $signature = 'tasks:report {--project_id=}';

    protected $description = 'Generate a report of tasks';

    public function handle(): int
    {
        $projectId = $this->option('project_id');

        $query = Task::query();

        if ($projectId) {
            $query->where('project_id', $projectId);
        }

        $tasks = $query->get();

        if ($tasks->isEmpty()) {
            $this->warn('No tasks found.');

            return self::SUCCESS;
        }

        $this->info('Task report:');

        $this->table(
            ['ID', 'Назва', 'Статус', 'Дедлайн'],
            $tasks->map(function ($task) {
                return [
                    $task->id,
                    $task->title,
                    $task->status,
                    $task->due_date,
                ];
            })->toArray()
        );

        return self::SUCCESS;
    }
}
