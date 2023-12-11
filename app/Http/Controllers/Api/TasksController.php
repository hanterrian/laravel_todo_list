<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Filters\TaskQueryFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Task\CreateTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\OpenApi\Parameters\TaskListFilterParameters;
use App\Services\TaskListService;
use Illuminate\Http\Request;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class TasksController extends Controller
{
    public function __construct(
        private readonly TaskListService $taskListService
    ) {
    }

    #[OpenApi\Operation(tags: ['todo'], method: 'GET')]
    #[OpenApi\Parameters(factory: TaskListFilterParameters::class)]
    public function index(Request $request, TaskQueryFilter $filter)
    {
        return $this->taskListService->getAll($filter, $request);
    }

    #[OpenApi\Operation(tags: ['todo'], method: 'POST')]
    public function store(CreateTaskRequest $request)
    {
        return $this->taskListService->store($request);
    }

    #[OpenApi\Operation(tags: ['todo'], method: 'GET')]
    public function show(int $id)
    {
        return $this->taskListService->getOne($id);
    }

    #[OpenApi\Operation(tags: ['todo'], method: 'GET')]
    public function complete(int $id)
    {
        return response()->json([
            'status' => $this->taskListService->markAsDone($id),
        ]);
    }

    #[OpenApi\Operation(tags: ['todo'], method: 'PUT')]
    public function update(UpdateTaskRequest $request, int $id)
    {
        return $this->taskListService->update($id, $request);
    }

    #[OpenApi\Operation(tags: ['todo'], method: 'DELETE')]
    public function destroy(int $id)
    {
        return response()->json([
            'status' => $this->taskListService->delete($id),
        ]);
    }
}
