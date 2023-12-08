<?php

namespace App\DTO;

use App\Enums\TaskStatusEnum;
use Spatie\LaravelData\Data;

class TaskFilterDTO extends Data
{
    public function __construct(
        public ?TaskStatusEnum $status = null,
        public ?int $priority = null,
        public ?string $title = null,
        public ?string $description = null,
        public ?string $sort = null,
    ) {
    }
}
