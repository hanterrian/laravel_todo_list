<?php

declare(strict_types=1);

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Spatie\LaravelData\Data;

/**
 * Main class to filter query scope
 */
abstract class QueryFilter
{
    /**
     * @var Builder
     */
    protected Builder $builder;

    public function apply(Builder $builder, Data $dto): Builder
    {
        $this->builder = $builder;

        foreach ($dto->all() as $name => $value) {
            if (method_exists($this, $name)) {
                $_value = array_filter([$value]);

                if (!empty($_value)) {
                    call_user_func_array([$this, $name], $_value);
                }
            }
        }

        return $this->builder;
    }
}
