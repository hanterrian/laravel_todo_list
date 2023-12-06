<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Todo;

use App\Http\Controllers\Controller;
use App\Interfaces\Service\TodoListServiceInterface;

class DeleteController extends Controller
{
    public function __construct(
        private readonly TodoListServiceInterface $todoListService
    ) {
    }

    public function __invoke(int $id)
    {
        response()->json([
            'status' => $this->todoListService->delete($id),
        ]);
    }
}
