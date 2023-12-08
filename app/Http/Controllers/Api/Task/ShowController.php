<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Task;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Interfaces\Service\TaskListServiceInterface;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class ShowController extends Controller
{
    public function __construct(
        private readonly TaskListServiceInterface $taskListService
    ) {
    }

    /**
     * @param  int  $id
     * @return \App\DTO\TaskDTO
     */
    #[OpenApi\Operation(tags: ['todo'], method: 'GET')]
    public function __invoke(int $id)
    {
        return $this->taskListService->getOne($id);
    }
}
