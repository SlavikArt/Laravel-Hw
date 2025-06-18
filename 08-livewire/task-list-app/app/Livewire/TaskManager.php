<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Task;

class TaskManager extends Component
{
    public $tasks;
    public $name = '';

    public function mount()
    {
        $this->tasks = Task::orderByDesc('id')->get();
    }

    public function createTask()
    {
        if (trim($this->name) === '') return;
        Task::create(['name' => $this->name, 'completed' => false]);
        $this->name = '';
        $this->tasks = Task::orderByDesc('id')->get();
    }

    public function toggleComplete($taskId)
    {
        $task = Task::find($taskId);
        if ($task) {
            $task->completed = !$task->completed;
            $task->save();
            $this->tasks = Task::orderByDesc('id')->get();
        }
    }

    public function deleteTask($taskId)
    {
        Task::where('id', $taskId)->delete();
        $this->tasks = Task::orderByDesc('id')->get();
    }

    public function render()
    {
        return view('livewire.task-manager');
    }
}
