<?php

namespace App\Interfaces\Task;

interface CreateInterface 
{
    public function create(string $title, string $description);
}
