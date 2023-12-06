<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Todo;

use App\Http\Controllers\Controller;
use App\Http\Resources\TodoResource;
use App\Interfaces\Service\TodoListServiceInterface;

class ShowController extends Controller
{
    public function __construct(
        private readonly TodoListServiceInterface $todoListService
    ) {
    }

    public function __invoke(int $id)
    {
        return new TodoResource($this->todoListService->getOne($id));
    }
}
