<?php

namespace App\Services;

use App\Repositories\TaskRepository;

class TaskService
{
    private $TaskRepository;

    public function __construct(TaskRepository $TaskRepository) {
        $this->TaskRepository = $TaskRepository;
    }

    public function getAllTasks()
    {
        return $this->TaskRepository->getAll();
    }

    public function getTaskById($id)
    {
        return $this->TaskRepository->getById($id);
    }
}
