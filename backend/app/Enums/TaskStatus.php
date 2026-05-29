<?php

declare(strict_types=1);

namespace App\Enums;

enum TaskStatus: string
{
    case Pending = 'pending';
    case Done = 'done';

    public function isDone(): bool
    {
        return $this === self::Done;
    }

    public static function fromBool(bool $isDone): self
    {
        return $isDone ? self::Done : self::Pending;
    }
}
