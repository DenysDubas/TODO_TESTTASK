<?php

declare(strict_types=1);

namespace App\Contracts;

use App\DTOs\CreateTaskDto;
use App\DTOs\UpdateTaskDto;
use App\Models\Task;

interface TaskRepositoryInterface
{
    /** @return list<Task> */
    public function all(): array;

    public function findById(int $id): ?Task;

    public function create(CreateTaskDto $dto): Task;

    public function update(Task $task, UpdateTaskDto $dto): Task;

    public function delete(Task $task): void;
}
