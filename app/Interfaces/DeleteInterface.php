<?php

declare(strict_types = 1);

namespace App\Interfaces;

// Svaki entity ce imati ovaj interface
interface DeleteInterface 
{
    public function delete(string $id);
}
