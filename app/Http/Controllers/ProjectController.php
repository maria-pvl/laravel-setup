<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Resources\ProjectResource;

class ProjectController extends Controller
{
    // Отримання списку проєктів з пагінацією
    public function index()
    {
        $projects = Project::with('user')->paginate(10);

        return ProjectResource::collection($projects);
    }

    // Створення нового проєкту
    public function store(StoreProjectRequest $request)
    {
        $project = Project::create($request->validated());

        return new ProjectResource($project->load('user'));
    }

    // Отримання одного проєкту
    public function show(Project $project)
    {
        return new ProjectResource($project->load('user'));
    }

    // Оновлення проєкту
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $project->update($request->validated());

        return new ProjectResource($project->load('user'));
    }

    // Видалення проєкту
    public function destroy(Project $project)
    {
        $project->delete();

        return response()->noContent();
    }
}
