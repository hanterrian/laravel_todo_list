<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Task;

use App\Http\Controllers\Controller;
use App\Interfaces\Service\TaskListServiceInterface;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class DeleteController extends Controller
{
    public function __construct(
        private readonly TaskListServiceInterface $todoListService
    ) {
    }

    /**
     * Delete todo
     *
     * @param  int  $id
     * @return void
     */
    #[OpenApi\Operation(tags: ['todo'], method: 'DELETE')]
    public function __invoke(int $id)
    {
        response()->json([
            'status' => $this->todoListService->delete($id),
        ]);
    }
}
