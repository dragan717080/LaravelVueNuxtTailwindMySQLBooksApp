<?php

declare(strict_types = 1);

namespace App\Services;

use App\Repositories\TaskRepository;

use App\Interfaces\{ ReadInterface, DeleteInterface };
use App\Interfaces\Task\{ CreateInterface, UpdateInterface };

use Illuminate\Database\Eloquent\Collection;
use App\Models\Task;

// Drzao sam se interface segregation principa iz SOLID-a
class TaskService implements CreateInterface, 
    ReadInterface, UpdateInterface, DeleteInterface
{
    // Ubacio sam property promotion da skratim
    public function __construct(private TaskRepository $taskRepository) {}

    public function getAll(): Collection
    {
        return $this->taskRepository->getAll();
    }

    public function getById(string $id): ?Task
    {
        return $this->taskRepository->getById($id);
    }

    public function create(string $title, string $description): Task
    {
        return $this->taskRepository->create($title, $description);
    }

    public function update(string $id, ?string $title, ?string $description, ?bool $isCompleted): ?Task
    {
        return $this->taskRepository->update($id, $title, $description, $isCompleted);
    }

    public function delete(string $id): int
    {
        return $this->taskRepository->delete($id);
    }
}
