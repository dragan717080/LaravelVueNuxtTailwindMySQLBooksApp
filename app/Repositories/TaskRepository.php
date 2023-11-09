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

    public function update($id, $title, $description, $isCompleted)
    {
        $task = $this->model->find($id);
    
        if (!$task) {
            return null;
        }
    
        if ($title !== null) {
            $task->title = $title;
        }

        if ($description !== null) {
            $task->description = $description;
        }
    
        if ($isCompleted !== null) {
            $task->isCompleted = $isCompleted;
        }
    
        $task->save();
    
        return $task;
    }

    public function create($title, $description)
    {
        return $this->model->create([
            'title' => $title,
            'description' => $description,
            'isCompleted' => false,
        ]);
    }
}
