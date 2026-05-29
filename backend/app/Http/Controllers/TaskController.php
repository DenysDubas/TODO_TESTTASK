<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\TaskServiceInterface;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    public function __construct(
        private readonly TaskServiceInterface $taskService,
    ) {}

    public function index(): JsonResponse
    {
        return response()->json(
            array_map(fn ($dto) => $dto->toArray(), $this->taskService->list()),
        );
    }

    public function store(StoreTaskRequest $request): JsonResponse
    {
        return response()->json(
            $this->taskService->create($request->toDto())->toArray(),
            201,
        );
    }

    public function update(UpdateTaskRequest $request, int $task): JsonResponse
    {
        return response()->json(
            $this->taskService->update($task, $request->toDto())->toArray(),
        );
    }

    public function destroy(int $task): JsonResponse
    {
        $this->taskService->delete($task);

        return response()->json(null, 204);
    }
}
