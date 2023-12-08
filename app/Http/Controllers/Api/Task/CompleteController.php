<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Task;

use App\Http\Controllers\Controller;
use App\Interfaces\Service\TaskListServiceInterface;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class CompleteController extends Controller
{
    public function __construct(
        private readonly TaskListServiceInterface $todoListService
    ) {
    }

    /**
     * Complete todo
     *
     * @param  int  $id
     * @return void
     */
    #[OpenApi\Operation(tags: ['todo'], method: 'GET')]
    public function __invoke(int $id)
    {
        response()->json([
            'status' => $this->todoListService->markAsDone($id),
        ]);
    }
}
