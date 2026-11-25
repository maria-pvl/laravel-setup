<?php

namespace App\Http\Controllers;

use App\Services\ExternalTaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ExternalApiController extends Controller
{
    private ExternalTaskService $externalTaskService;

    public function __construct(ExternalTaskService $externalTaskService)
    {
        $this->externalTaskService = $externalTaskService;
    }

    public function index(): JsonResponse
    {
        $tasks = $this->externalTaskService->getExternalTasks();

        return response()->json($tasks);
    }

    public function show($id): JsonResponse
    {
        $task = $this->externalTaskService->getExternalTaskById($id);

        if (!$task) {
            return response()->json([
                'message' => 'External task not found or API request failed.',
            ], 404);
        }

        return response()->json($task);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'completed' => 'required|boolean',
            'userId' => 'required|integer',
        ]);

        $task = $this->externalTaskService->sendTaskData($validated);

        if (!$task) {
            return response()->json([
                'message' => 'Failed to send task to external API.',
            ], 502);
        }

        return response()->json($task, 201);
    }
}
