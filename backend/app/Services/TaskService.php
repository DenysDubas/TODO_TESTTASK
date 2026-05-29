<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\TaskRepositoryInterface;
use App\Contracts\TaskServiceInterface;
use App\DTOs\CreateTaskDto;
use App\DTOs\TaskDto;
use Illuminate\Database\Eloquent\ModelNotFoundException;

final class TaskService implements TaskServiceInterface
{
    public function __construct(
        private readonly TaskRepositoryInterface $tasks,
    ) {}

    public function list(): array
    {
        return array_map(
            TaskDto::fromModel(...),
            $this->tasks->all(),
        );
    }

    public function create(CreateTaskDto $dto): TaskDto
    {
        return TaskDto::fromModel($this->tasks->create($dto));
    }

    public function delete(int $id): void
    {
        $task = $this->tasks->findById($id);

        if ($task === null) {
            throw new ModelNotFoundException();
        }

        $this->tasks->delete($task);
    }
}
