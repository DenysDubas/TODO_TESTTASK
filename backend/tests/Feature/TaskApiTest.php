<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_all_tasks(): void
    {
        Task::factory()->count(3)->create();

        $this->getJson('/api/tasks')
            ->assertOk()
            ->assertJsonCount(3);
    }

    public function test_can_create_task(): void
    {
        $this->postJson('/api/tasks', ['title' => 'Buy milk'])
            ->assertCreated()
            ->assertJsonFragment(['title' => 'Buy milk', 'is_done' => false]);
    }

    public function test_create_task_requires_title(): void
    {
        $this->postJson('/api/tasks', [])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['title']);
    }

    public function test_can_delete_task(): void
    {
        $task = Task::factory()->create();

        $this->deleteJson("/api/tasks/{$task->id}")
            ->assertNoContent();

        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }

    public function test_delete_nonexistent_task_returns_404(): void
    {
        $this->deleteJson('/api/tasks/999')
            ->assertNotFound();
    }
}
