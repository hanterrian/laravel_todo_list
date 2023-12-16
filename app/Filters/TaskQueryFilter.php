<?php

declare(strict_types=1);

namespace App\Filters;

use App\Enums\TaskStatusEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

/**
 * Task list filter builder
 */
class TaskQueryFilter extends QueryFilter
{
    /**
     * Filter by task status
     *
     * @param  TaskStatusEnum  $status
     * @return void
     */
    public function status(TaskStatusEnum $status): void
    {
        $this->builder->where('status', $status);
    }

    /**
     * Filter by priority
     *
     * @param  int  $priority
     * @return void
     */
    public function priority(int $priority): void
    {
        $this->builder->where('priority', $priority);
    }

    /**
     * Search by title
     *
     * @param  string  $title
     * @return void
     */
    public function title(string $title): void
    {
        $this->builder->whereFullText('title', $title);
    }

    /**
     * Search by description
     *
     * @param  string  $description
     * @return void
     */
    public function description(string $description): void
    {
        $this->builder->whereFullText('description', $description);
    }

    /**
     * Process sort query
     *
     * @param  string  $sort
     * @return void
     */
    public function sort(string $sort): void
    {
        $allowedSortColumnMap = [
            'createdAt' => 'created_at',
            'completedAt' => 'completed_at',
            'priority' => 'priority',
        ];

        $sorts = explode(',', $sort);

        foreach ($sorts as $sortColumn) {
            $sortColumn = trim($sortColumn);
            $sortDirection = Str::startsWith($sortColumn, '-') ? 'desc' : 'asc';
            $sortColumn = ltrim($sortColumn, '-');

            if (isset($allowedSortColumnMap[$sortColumn])) {
                $this->builder->orderBy($allowedSortColumnMap[$sortColumn], $sortDirection);
            }
        }
    }
}
