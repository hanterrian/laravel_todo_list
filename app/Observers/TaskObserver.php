<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Task;
use Auth;

class TaskObserver
{
    /**
     * Handle the Task "created" event.
     *
     * @param  Task  $todo
     * @return void
     */
    public function creating(Task $todo): void
    {
        $todo->owner_id = $todo->owner_id ?? Auth::id();
    }
}
