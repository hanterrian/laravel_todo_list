<?php

declare(strict_types=1);

namespace App\DTO;

use App\Enums\TaskStatusEnum;
use Carbon\CarbonImmutable;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class TaskDTO extends Data
{
    public function __construct(
        public ?int $id,
        public ?int $parent_id,
        public TaskStatusEnum $status,
        public int $priority,
        public string $title,
        public string $description,
        public $children,
        public ?CarbonImmutable $createdAt,
        public ?CarbonImmutable $completedAt,
    ) {
    }
}
