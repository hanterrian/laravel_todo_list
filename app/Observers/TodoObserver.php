<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Todo;
use Auth;

class TodoObserver
{
    /**
     * Handle the Todo "created" event.
     *
     * @param  Todo  $todo
     * @return void
     */
    public function creating(Todo $todo): void
    {
        $todo->owner_id = $todo->owner_id ?? Auth::id();
    }
}
