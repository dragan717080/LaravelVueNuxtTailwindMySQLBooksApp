<?php

declare(strict_types = 1);

namespace App\Interfaces\Task;

interface UpdateInterface
{
    public function update(string $id, string $title, string $description, bool $isCompleted);
}
