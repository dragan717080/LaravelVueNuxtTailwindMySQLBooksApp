<?php

namespace App\Repositories;

use App\Models\Task;

class TaskRepository
{
    public function getAll()
    {
        return Task::all();
    }

    public function getById($id)
    {
        return Task::find($id);
    }
}
