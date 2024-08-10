<?php

namespace Tests\Unit;

use App\Models\Tasks;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskCRUDTest extends TestCase
{
    public function test_create_task()
    {
        $userIds = User::where('is_admin', false)->pluck('id')->toArray();
        $task = Tasks::create([
            'title' => 'New Task',
            'description' => 'Task Description',
            'assigned_to_id' => 2,
            'assigned_by_id' => 1,
        ]);

        $this->assertDatabaseHas('tasks', [
            'title' => 'New Task',
            'description' => 'Task Description',
            'assigned_to_id' => 2,
            'assigned_by_id' => 1,
        ]);
    }

    public function test_edit_task()
    {
        $userIds = User::where('is_admin', false)->pluck('id')->toArray();
        // dd($user);
        $task = Tasks::create([
            'title' => 'Old Title',
            'description' => 'Old Description',
            'assigned_to_id' => 2,
            'assigned_by_id' => 1,
        ]);

        $task->update([
            'title' => 'Updated Title',
            'description' => 'Updated Description',
        ]);

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'title' => 'Updated Title',
            'description' => 'Updated Description',
        ]);

        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id,
            'title' => 'Old Title',
            'description' => 'Old Description',
        ]);
    }

    public function test_delete_task()
    {
        $userIds = User::where('is_admin', false)->pluck('id')->toArray();
        $task = Tasks::create([
            'title' => 'Task to Delete',
            'description' => 'Description of task to delete',
            'assigned_to_id' => 2,
            'assigned_by_id' => 1,
        ]);

        $task->delete();

        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id,
            'title' => 'Task to Delete',
        ]);
    }
}
