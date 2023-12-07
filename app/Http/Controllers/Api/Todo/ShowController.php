<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Todo;

use App\Http\Controllers\Controller;
use App\Http\Resources\TodoResource;
use App\Interfaces\Service\TodoListServiceInterface;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class ShowController extends Controller
{
    public function __construct(
        private readonly TodoListServiceInterface $todoListService
    ) {
    }

    /**
     * Show todo
     *
     * @param  int  $id
     * @return TodoResource
     */
    #[OpenApi\Operation(tags: ['todo'], method: 'GET')]
    public function __invoke(int $id)
    {
        return new TodoResource($this->todoListService->getOne($id));
    }
}
