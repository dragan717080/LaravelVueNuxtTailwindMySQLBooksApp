<?php

use App\Http\Controllers\TaskController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::controller(TaskController::class)->group(function() {
    Route::get('/', 'getAll');
    Route::get('/{id}', 'getById');
    Route::post('/', 'create');
    Route::patch('/{id}', 'update');
    Route::delete('/{id}', 'delete');
});
