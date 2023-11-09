<?php

declare(strict_types = 1);

namespace App\Interfaces;

// Svaki entity ce imati ovaj interface
interface ReadInterface
{
    public function getAll();
    public function getById(string $id);
}
