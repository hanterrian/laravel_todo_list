<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Todo;

use App\Http\Controllers\Controller;
use App\Http\Resources\TodoResource;
use App\Interfaces\Service\TodoListServiceInterface;
use Illuminate\Http\Request;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class UpdateController extends Controller
{
    public function __construct(
        private readonly TodoListServiceInterface $todoListService
    ) {
    }

    /**
     * Update todo
     *
     * @param  int  $id
     * @param  Request  $request
     * @return TodoResource
     */
    #[OpenApi\Operation(tags: ['todo'], method: 'PUT')]
    public function __invoke(int $id, Request $request)
    {
        return new TodoResource($this->todoListService->update($id, $request));
    }
}
