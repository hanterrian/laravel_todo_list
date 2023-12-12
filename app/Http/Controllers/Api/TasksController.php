<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Data\TaskData;
use App\Filters\TaskQueryFilter;
use App\Http\Controllers\Controller;
use App\OpenApi\Parameters\TaskIdParameters;
use App\OpenApi\Parameters\TaskListFilterParameters;
use App\OpenApi\RequestBodies\TaskDataRequestBody;
use App\OpenApi\Responses\DummyResponse;
use App\OpenApi\Responses\Error\ErrorForbiddenResponse;
use App\OpenApi\Responses\Error\ErrorNotFoundResponse;
use App\OpenApi\Responses\Error\ErrorUnauthenticatedResponse;
use App\OpenApi\Responses\Error\ErrorValidationResponse;
use App\OpenApi\Responses\FormTaskResponse;
use App\OpenApi\Responses\ListTaskResponse;
use App\OpenApi\Responses\TaskResponse;
use App\Services\TaskListService;
use Illuminate\Http\Request;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

/**
 * Api tasks controller, use to list, view, create, update, complete and delete task.
 *
 * TasksController
 * @package App\Http\Controllers\Api
 *
 * @property TaskListService $taskListService Tasks operation service
 */
#[OpenApi\PathItem]
class TasksController extends Controller
{
    /**
     * @param  TaskListService  $taskListService  Tasks operation service.
     *
     * @return void
     */
    public function __construct(
        private readonly TaskListService $taskListService
    ) {
    }

    /**
     * List of tasks
     *
     * @param  Request  $request
     * @param  TaskQueryFilter  $filter
     * @return \Spatie\LaravelData\DataCollection<TaskData> The response with the collection of tasks items that match the provided filters
     */
    #[OpenApi\Operation(tags: ['task'], security: 'BearerToken', method: 'GET')]
    #[OpenApi\Parameters(factory: TaskListFilterParameters::class)]
    #[OpenApi\Response(factory: ListTaskResponse::class)]
    #[OpenApi\Response(factory: ErrorUnauthenticatedResponse::class, statusCode: 401)]
    #[OpenApi\Response(factory: ErrorForbiddenResponse::class, statusCode: 401)]
    public function index(Request $request, TaskQueryFilter $filter)
    {
        return $this->taskListService->getAll($filter, $request);
    }

    /**
     * Create new task
     *
     * @param  TaskData  $request  The incoming request data (validated by rule)
     * @return \Illuminate\Http\JsonResponse The JSON response with new task data
     */
    #[OpenApi\Operation(tags: ['task'], security: 'BearerToken', method: 'POST')]
    #[OpenApi\RequestBody(factory: TaskDataRequestBody::class)]
    #[OpenApi\Response(factory: FormTaskResponse::class, statusCode: 201)]
    #[OpenApi\Response(factory: ErrorUnauthenticatedResponse::class, statusCode: 401)]
    #[OpenApi\Response(factory: ErrorForbiddenResponse::class, statusCode: 401)]
    #[OpenApi\Response(factory: ErrorNotFoundResponse::class, statusCode: 404)]
    #[OpenApi\Response(factory: ErrorValidationResponse::class, statusCode: 422)]
    public function store(TaskData $request)
    {
        return response()->json([
            'data' => $this->taskListService->store($request),
        ], 201);
    }

    /**
     * Show task data
     *
     * @param  int  $id  ID shows task
     * @return TaskData The DTO with task data
     */
    #[OpenApi\Operation(tags: ['task'], security: 'BearerToken', method: 'GET')]
    #[OpenApi\Parameters(factory: TaskIdParameters::class)]
    #[OpenApi\Response(factory: TaskResponse::class, statusCode: 200)]
    #[OpenApi\Response(factory: ErrorUnauthenticatedResponse::class, statusCode: 401)]
    #[OpenApi\Response(factory: ErrorForbiddenResponse::class, statusCode: 401)]
    #[OpenApi\Response(factory: ErrorNotFoundResponse::class, statusCode: 404)]
    public function show(int $id)
    {
        return $this->taskListService->getOne($id);
    }

    /**
     * Complete task
     *
     * @param  int  $id  ID completed task
     * @return \Illuminate\Http\JsonResponse The JSON response without content
     */
    #[OpenApi\Operation(tags: ['task'], security: 'BearerToken', method: 'PATCH')]
    #[OpenApi\Parameters(factory: TaskIdParameters::class)]
    #[OpenApi\Response(factory: DummyResponse::class, statusCode: 204)]
    #[OpenApi\Response(factory: ErrorUnauthenticatedResponse::class, statusCode: 401)]
    #[OpenApi\Response(factory: ErrorForbiddenResponse::class, statusCode: 401)]
    #[OpenApi\Response(factory: ErrorNotFoundResponse::class, statusCode: 404)]
    public function complete(int $id)
    {
        $this->taskListService->markAsDone($id);

        return response()->json([], 204);
    }

    /**
     * Update task data
     *
     * @param  TaskData  $request  The incoming request data (validated by rule)
     * @param  int  $id  ID updated task
     * @return \Illuminate\Http\JsonResponse The JSON response without content
     */
    #[OpenApi\Operation(tags: ['task'], security: 'BearerToken', method: 'PUT')]
    #[OpenApi\Parameters(factory: TaskIdParameters::class)]
    #[OpenApi\RequestBody(factory: TaskDataRequestBody::class)]
    #[OpenApi\Response(factory: DummyResponse::class, statusCode: 204)]
    #[OpenApi\Response(factory: ErrorUnauthenticatedResponse::class, statusCode: 401)]
    #[OpenApi\Response(factory: ErrorForbiddenResponse::class, statusCode: 401)]
    #[OpenApi\Response(factory: ErrorNotFoundResponse::class, statusCode: 404)]
    #[OpenApi\Response(factory: ErrorValidationResponse::class, statusCode: 422)]
    public function update(TaskData $request, int $id)
    {
        $this->taskListService->update($id, $request);

        return response()->json([], 204);
    }

    /**
     * Delete task
     *
     * @param  int  $id  ID deleted task
     * @return \Illuminate\Http\JsonResponse The JSON response without content
     */
    #[OpenApi\Operation(tags: ['task'], security: 'BearerToken', method: 'DELETE')]
    #[OpenApi\Parameters(factory: TaskIdParameters::class)]
    #[OpenApi\Response(factory: DummyResponse::class, statusCode: 204)]
    #[OpenApi\Response(factory: ErrorUnauthenticatedResponse::class, statusCode: 401)]
    #[OpenApi\Response(factory: ErrorForbiddenResponse::class, statusCode: 401)]
    #[OpenApi\Response(factory: ErrorNotFoundResponse::class, statusCode: 404)]
    public function destroy(int $id)
    {
        $this->taskListService->delete($id);

        return response()->json([], 204);
    }
}
