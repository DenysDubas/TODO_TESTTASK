<?php

declare(strict_types=1);

namespace App\DTOs;

final readonly class UpdateTaskDto
{
    public function __construct(
        public string $title,
    ) {}
}
