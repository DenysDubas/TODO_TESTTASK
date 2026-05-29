<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\DTOs\CreateTaskDto;
use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
        ];
    }

    public function toDto(): CreateTaskDto
    {
        return new CreateTaskDto(
            title: $this->validated('title'),
        );
    }
}
