<?php

declare(strict_types=1);

namespace App\Contracts;

use App\DTOs\CreateTaskDto;
use App\DTOs\TaskDto;

interface TaskServiceInterface
{
    /** @return list<TaskDto> */
    public function list(): array;

    public function create(CreateTaskDto $dto): TaskDto;

    public function delete(int $id): void;
}
