<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\TaskRepositoryInterface;
use App\DTOs\CreateTaskDto;
use App\DTOs\UpdateTaskDto;
use App\Models\Task;

final class EloquentTaskRepository implements TaskRepositoryInterface
{
    public function all(): array
    {
        return Task::query()->latest()->get()->all();
    }

    public function findById(int $id): ?Task
    {
        return Task::query()->find($id);
    }

    public function create(CreateTaskDto $dto): Task
    {
        $task = Task::query()->create(['title' => $dto->title]);

        return $task->refresh();
    }

    public function update(Task $task, UpdateTaskDto $dto): Task
    {
        $task->update(['title' => $dto->title]);

        return $task->refresh();
    }

    public function delete(Task $task): void
    {
        $task->delete();
    }
}
