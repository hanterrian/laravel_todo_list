<?php

declare(strict_types=1);

namespace App\Enums;

enum TodoStatusEnum: string
{
    case TODO = 'todo';
    case DONE = 'done';
}
