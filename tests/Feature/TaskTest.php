<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_task_list_page_can_be_rendered(): void
    {
        Task::factory()->count(3)->create();

        $response = $this->get(route('tasks.index'));

        $response->assertStatus(200);
        $response->assertViewIs('tasks.index');
    }

    public function test_a_task_can_be_created(): void
    {
        $response = $this->post(route('tasks.store'), [
            'title' => 'Menyelesaikan pipeline CI/CD',
            'description' => 'Tugas KEPL bagian 3',
        ]);

        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', [
            'title' => 'Menyelesaikan pipeline CI/CD',
        ]);
    }

    public function test_a_task_can_be_updated(): void
    {
        $task = Task::factory()->create(['is_completed' => false]);

        $response = $this->put(route('tasks.update', $task), [
            'title' => $task->title,
            'description' => $task->description,
            'is_completed' => true,
        ]);

        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'is_completed' => true,
        ]);
    }

    public function test_a_task_can_be_deleted(): void
    {
        $task = Task::factory()->create();

        $response = $this->delete(route('tasks.destroy', $task));

        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
