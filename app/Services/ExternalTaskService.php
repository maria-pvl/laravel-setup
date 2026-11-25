<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ExternalTaskService
{
    private string $baseUrl = 'https://jsonplaceholder.typicode.com';

    public function getExternalTasks(): array
    {
        try {
            $response = Http::timeout(5)->get($this->baseUrl . '/todos');

            if ($response->successful()) {
                Log::info('External tasks received', [
                    'status' => $response->status(),
                ]);

                return $response->json();
            }

            if ($response->failed()) {
                Log::error('Failed to get external tasks', [
                    'status' => $response->status(),
                ]);
            }

            return [];
        } catch (\Exception $e) {
            Log::error('External API connection error', [
                'message' => $e->getMessage(),
            ]);

            return [];
        }
    }

    public function getExternalTaskById($id): ?array
    {
        try {
            $response = Http::timeout(5)->get(
                $this->baseUrl . '/todos/' . $id
            );

            if ($response->successful()) {
                Log::info('External task received', [
                    'id' => $id,
                    'status' => $response->status(),
                ]);

                return $response->json();
            }

            if ($response->failed()) {
                Log::error('Failed to get external task', [
                    'id' => $id,
                    'status' => $response->status(),
                ]);
            }

            return null;
        } catch (\Exception $e) {
            Log::error('External API connection error', [
                'id' => $id,
                'message' => $e->getMessage(),
            ]);

            return null;
        }
    }

    public function sendTaskData(array $data): ?array
    {
        try {
            $response = Http::timeout(5)->post(
                $this->baseUrl . '/todos',
                [
                    'title' => $data['title'],
                    'completed' => $data['completed'],
                    'userId' => $data['userId'],
                ]
            );

            if ($response->successful()) {
                Log::info('Task sent to external API', [
                    'status' => $response->status(),
                ]);

                return $response->json();
            }

            if ($response->failed()) {
                Log::error('Failed to send task to external API', [
                    'status' => $response->status(),
                ]);
            }

            return null;
        } catch (\Exception $e) {
            Log::error('External API connection error', [
                'message' => $e->getMessage(),
            ]);

            return null;
        }
    }
}
