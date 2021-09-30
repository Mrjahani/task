<?php

namespace App\Repositories;

use App\Models\Task;

class TaskRepository
{
    public function all()
    {
        return Task::orderBy('id', 'DESC')->get();
    }

    public function create($message)
    {
        return Task::create([
            'message' => $message,
        ]);
    }

    public function find($id)
    {
        return Task::find($id);
    }

    public function update($id , $message)
    {
        $task = Task::find($id);
        $task->update([
            'message' => $message,
        ]);
    }
}
