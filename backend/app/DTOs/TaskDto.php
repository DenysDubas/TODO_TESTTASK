<?php

declare(strict_types=1);

namespace App\DTOs;

use App\Enums\TaskStatus;
use App\Models\Task;

final readonly class TaskDto
{
    public function __construct(
        public int $id,
        public string $title,
        public TaskStatus $status,
        public string $createdAt,
        public string $updatedAt,
    ) {}

    public static function fromModel(Task $task): self
    {
        return new self(
            id: $task->id,
            title: $task->title,
            status: TaskStatus::fromBool((bool) $task->is_done),
            createdAt: $task->created_at->toJSON(),
            updatedAt: $task->updated_at->toJSON(),
        );
    }

    public function toArray(): array
    {
        return [
            'id'         => $this->id,
            'title'      => $this->title,
            'is_done'    => $this->status->isDone(),
            'status'     => $this->status->value,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
        ];
    }
}
