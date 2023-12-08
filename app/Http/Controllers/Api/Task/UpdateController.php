<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Task;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Interfaces\Service\TaskListServiceInterface;
use Illuminate\Http\Request;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class UpdateController extends Controller
{
    public function __construct(
        private readonly TaskListServiceInterface $taskListService
    ) {
    }

    #[OpenApi\Operation(tags: ['todo'], method: 'PUT')]
    public function __invoke(int $id, Request $request)
    {
        return $this->taskListService->update($id, $request);
    }
}
