<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Task;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Interfaces\Service\TaskListServiceInterface;
use App\OpenApi\Parameters\TaskListFilterParameters;
use Illuminate\Http\Request;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class ListController extends Controller
{
    public function __construct(
        private readonly TaskListServiceInterface $taskListService
    ) {
    }

    /**
     * @param  Request  $request
     * @return \Spatie\LaravelData\DataCollection
     */
    #[OpenApi\Operation(tags: ['todo'], method: 'GET')]
    #[OpenApi\Parameters(factory: TaskListFilterParameters::class)]
    public function __invoke(Request $request)
    {
        return $this->taskListService->getAll($request);
    }
}
