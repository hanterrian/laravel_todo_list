<?php

namespace App\Observers;

use App\Models\Todo;

class TodoObserver
{
    /**
     * Handle the Todo "created" event.
     *
     * @param  \App\Models\Todo  $todo
     * @return void
     */
    public function creating(Todo $todo): void
    {
        $todo->owner_id = \Auth::user()->id;
    }
}
