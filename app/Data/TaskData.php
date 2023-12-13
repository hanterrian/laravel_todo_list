<?php

declare(strict_types=1);

namespace App\Data;

use App\Enums\TaskStatusEnum;
use App\Models\Task;
use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\Enum;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Numeric;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

/**
 * Task DTO
 */
class TaskData extends Data
{
    /**
     * @param  int|null  $id
     * @param  int|null  $parent_id
     * @param  TaskStatusEnum  $status
     * @param  int  $priority
     * @param  string  $title
     * @param  string  $description
     * @param  DataCollection<TaskData>|null  $children
     * @param  Carbon|null  $createdAt
     * @param  Carbon|null  $completedAt
     */
    public function __construct(
        public ?int $id,
        #[Numeric, Exists('tasks', 'id')]
        public ?int $parent_id,
        #[Required, Enum(TaskStatusEnum::class)]
        public TaskStatusEnum $status,
        #[Required, Numeric, Min(1), Max(5)]
        public int $priority,
        #[Required, StringType, Max(255)]
        public string $title,
        #[Required, StringType, Max(50000)]
        public string $description,
        #[DataCollectionOf(TaskData::class), MapName('subTasks')]
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
            children: TaskData::collection($task->children),
            createdAt: $task->created_at,
            completedAt: $task->completed_at,
        );
    }
}
