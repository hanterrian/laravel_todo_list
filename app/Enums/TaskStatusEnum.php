<?php

declare(strict_types=1);

namespace App\Enums;

enum TaskStatusEnum: string
{
    case TODO = 'todo';
    case DONE = 'done';
}
