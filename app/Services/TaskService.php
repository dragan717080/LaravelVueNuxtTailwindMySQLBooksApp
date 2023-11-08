<?php

namespace App\Services;

use App\Repositories\TaskRepository;

class TaskService
{
    public function __construct(private TaskRepository $taskRepository) {}

    public function getAll()
    {
        return $this->taskRepository->getAll();
    }

    public function getById($id)
    {
        return $this->taskRepository->getById($id);
    }

    public function create($name)
    {
        return $this->taskRepository->create($name);
    }

    public function update($id, $name, $isCompleted) {
        return $this->taskRepository->update($id, $name, $isCompleted);
    }

    public function delete($id) {
        return $this->taskRepository->delete($id);
    }
}
