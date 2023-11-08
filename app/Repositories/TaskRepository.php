<?php

namespace App\Repositories;

use App\Models\Task;
use App\Repositories\Traits\{ GetByIdTrait, DeleteTrait };

class TaskRepository
{
    use GetByIdTrait;
    use DeleteTrait;

    public $model;

    public function __construct()
    {
        $this->model = new Task();
    }

    public function getAll()
    {
        return Task::all();
    }

    public function update($id, $name, $isCompleted)
    {
        $task = $this->model->find($id);
    
        if (!$task) {
            return null;
        }
    
        if ($name !== null) {
            $task->name = $name;
        }
    
        if ($isCompleted !== null) {
            $task->isCompleted = $isCompleted;
        }
    
        $task->save();
    
        return $task;
    }

    public function create($name)
    {
        return $this->model->create([
            'name' => $name,
            'isCompleted' => false,
        ]);
    }
}
