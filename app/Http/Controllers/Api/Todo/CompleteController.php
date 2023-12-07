<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Todo;

use App\Http\Controllers\Controller;
use App\Interfaces\Service\TodoListServiceInterface;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class CompleteController extends Controller
{
    public function __construct(
        private readonly TodoListServiceInterface $todoListService
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
