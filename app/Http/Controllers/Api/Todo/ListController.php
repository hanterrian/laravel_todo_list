<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Todo;

use App\Http\Controllers\Controller;
use App\Http\Resources\TodoResource;
use App\Interfaces\Service\TodoListServiceInterface;
use App\OpenApi\Parameters\TodoListFilterParameters;
use App\OpenApi\RequestBodies\TodoListRequestBody;
use Illuminate\Http\Request;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class ListController extends Controller
{
    public function __construct(
        private readonly TodoListServiceInterface $todoListService
    ) {
    }

    /**
     * List of todos
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    #[OpenApi\Operation(tags: ['todo'], method: 'GET')]
    #[OpenApi\Parameters(factory: TodoListFilterParameters::class)]
    public function __invoke(Request $request)
    {
        return TodoResource::collection($this->todoListService->getAll($request));
    }
}
