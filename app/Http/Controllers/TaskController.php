<?php

namespace App\Http\Controllers;

use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Http\ResponseBuilder;

class TaskController extends BaseController
{
    public function __construct(private TaskService $taskService) {}

    public function getAll()
    {
        return ResponseBuilder::getResponse(fn() => $this->taskService->getAll());
    }

    public function getById($id)
    {
        return ResponseBuilder::getResponse(
            fn() => $this->taskService->getById($id) ?: null
        );
    }

    public function create(Request $req)
    {
        return ResponseBuilder::getResponse(
            fn() => $this->taskService->create($req->name) ?: null
        );
    }    

    public function update($id, Request $req) {
        return ResponseBuilder::getResponse(
            fn() => $this->taskService->update($id, $req->input('name'), $req->input('isCompleted')) ?: null
        );
    }

    public function delete($id) {
        return ResponseBuilder::getResponse(
            fn() => $this->taskService->delete($id) ?: null
        );
    }
}
