<?php

declare(strict_types=1);

namespace App\Enums;

use ArchTech\Enums\Values;

/**
 * Task status list
 */
enum TaskStatusEnum: string
{
    use Values;

    case TODO = 'todo';
    case DONE = 'done';
}
