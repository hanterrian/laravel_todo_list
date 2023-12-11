<?php

declare(strict_types=1);

namespace App\DTO;

use App\Enums\TaskStatusEnum;
use App\Models\Task;
use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class TaskDTO extends Data
{
    /**
     * @param  int|null  $id
     * @param  int|null  $parent_id
     * @param  TaskStatusEnum  $status
     * @param  int  $priority
     * @param  string  $title
     * @param  string  $description
     * @param  DataCollection<TaskDTO>|null  $children
     * @param  Carbon|null  $createdAt
     * @param  Carbon|null  $completedAt
     */
    public function __construct(
        public ?int $id,
        public ?int $parent_id,
        public TaskStatusEnum $status,
        public int $priority,
        public string $title,
        public string $description,
        #[DataCollectionOf(TaskDTO::class), MapName('subTasks')]
        public ?DataCollection $children,
        public ?Carbon $createdAt,
        public ?Carbon $completedAt,
    ) {
    }

    public static function fromModel(Task $task): self
    {
        return new self(
            id: $task->id,
            parent_id: $task->parent_id,
            status: $task->status,
            priority: $task->priority,
            title: $task->title,
            description: $task->description,
            children: TaskDTO::collection($task->children),
            createdAt: $task->created_at,
            completedAt: $task->completed_at,
        );
    }
}
