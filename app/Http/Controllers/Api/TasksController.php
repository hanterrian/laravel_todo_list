<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\DTO\TaskDTO;
use App\Filters\TaskQueryFilter;
use App\Http\Controllers\Controller;
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
    public function store(TaskDTO $request)
    {
        return response()->json([
            'data' => $this->taskListService->store($request),
        ], 201);
    }

    #[OpenApi\Operation(tags: ['todo'], method: 'GET')]
    public function show(int $id)
    {
        return $this->taskListService->getOne($id);
    }

    #[OpenApi\Operation(tags: ['todo'], method: 'PATCH')]
    public function complete(int $id)
    {
        $this->taskListService->markAsDone($id);

        return response()->json([], 204);
    }

    #[OpenApi\Operation(tags: ['todo'], method: 'PUT')]
    public function update(TaskDTO $request, int $id)
    {
        $this->taskListService->update($id, $request);

        return response()->json([], 204);
    }

    #[OpenApi\Operation(tags: ['todo'], method: 'DELETE')]
    public function destroy(int $id)
    {
        $this->taskListService->delete($id);

        return response()->json([], 204);
    }
}
