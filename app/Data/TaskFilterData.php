<?php

declare(strict_types=1);

namespace App\Data;

use App\Enums\TaskStatusEnum;
use Spatie\LaravelData\Attributes\Validation\Enum;
use Spatie\LaravelData\Attributes\Validation\IntegerType;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Data;

class TaskFilterData extends Data
{
    public function __construct(
        #[Enum(TaskStatusEnum::class)]
        public ?TaskStatusEnum $status = null,
        #[Min(1), Max(5), IntegerType]
        public ?int $priority = null,
        #[Max(255), StringType]
        public ?string $title = null,
        #[Max(255), StringType]
        public ?string $description = null,
        #[StringType]
        public ?string $sort = null,
    ) {
    }
}
