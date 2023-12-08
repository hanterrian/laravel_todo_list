<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Task;

use App\Http\Controllers\Controller;
use App\Interfaces\Service\TaskListServiceInterface;
use Illuminate\Http\JsonResponse;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

/**
 * This class represents a controller responsible for completing tasks.
 *
 * Class CompleteController
 * @package App\Http\Controllers\Api\Task
 *
 * @property TaskListServiceInterface $taskListService The task list service interface implementation.
 */
#[OpenApi\PathItem]
class CompleteController extends Controller
{
    /**
     * Constructor for initializing the class.
     *
     * @param  TaskListServiceInterface  $taskListService  The task list service interface implementation.
     * @return void
     */
    public function __construct(
        private readonly TaskListServiceInterface $taskListService
    ) {
    }

    /**
     * Complete task
     *
     * @param  int  $id
     * @return JsonResponse
     */
    #[OpenApi\Operation(tags: ['todo'], method: 'GET')]
    public function __invoke(int $id): JsonResponse
    {
        return response()->json([
            'status' => $this->taskListService->markAsDone($id),
        ]);
    }
}
