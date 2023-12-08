<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\CreateTaskRequest;
use App\Interfaces\Service\TaskListServiceInterface;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class CreateController extends Controller
{
    public function __construct(
        private readonly TaskListServiceInterface $taskListService
    ) {
    }

    /**
     * @param  CreateTaskRequest  $request
     * @return \App\DTO\TaskDTO
     */
    #[OpenApi\Operation(tags: ['todo'], method: 'POST')]
    public function __invoke(CreateTaskRequest $request)
    {
        return $this->taskListService->store($request);
    }
}
