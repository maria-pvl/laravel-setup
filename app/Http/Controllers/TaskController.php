<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;

class TaskController extends Controller
{
    // Отримання списку завдань з пагінацією
    public function index()
    {
        $tasks = Task::with(['project', 'comments'])->paginate(10);

        return TaskResource::collection($tasks);
    }

    // Створення нового завдання
    public function store(StoreTaskRequest $request)
    {
        $task = Task::create($request->validated());

        return new TaskResource($task->load(['project', 'comments']));
    }

    // Отримання одного завдання
    public function show(Task $task)
    {
        $task->load(['project', 'comments']);

        return new TaskResource($task);
    }

    // Оновлення завдання
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->update($request->validated());

        return new TaskResource($task->load(['project', 'comments']));
    }

    // Видалення завдання
    public function destroy(Task $task)
    {
        $task->delete();

        return response()->noContent();
    }
}
