<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Todo;

use App\Http\Controllers\Controller;
use App\Http\Resources\TodoResource;
use App\Interfaces\Service\TodoListServiceInterface;
use Illuminate\Http\Request;

class CreateController extends Controller
{
    public function __construct(
        private readonly TodoListServiceInterface $todoListService
    ) {
    }

    public function __invoke(Request $request)
    {
        return new TodoResource($this->todoListService->store($request));
    }
}
