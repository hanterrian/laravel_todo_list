<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Task;

use App\Http\Controllers\Controller;
use App\Interfaces\Service\TaskListServiceInterface;
use Illuminate\Http\JsonResponse;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class DeleteController extends Controller
{
    public function __construct(
        private readonly TaskListServiceInterface $taskListService
    ) {
    }

    /**
     * Delete todo
     *
     * @param  int  $id
     * @return JsonResponse
     */
    #[OpenApi\Operation(tags: ['todo'], method: 'DELETE')]
    public function __invoke(int $id): JsonResponse
    {
        return response()->json([
            'status' => $this->taskListService->delete($id),
        ]);
    }
}
