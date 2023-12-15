<?php

declare(strict_types=1);

namespace App\OpenApi\Schemas;

use App\Enums\TaskStatusEnum;
use GoldSpecDigital\ObjectOrientedOAS\Contracts\SchemaContract;
use GoldSpecDigital\ObjectOrientedOAS\Objects\AllOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\AnyOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Not;
use GoldSpecDigital\ObjectOrientedOAS\Objects\OneOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;
use Vyuldashev\LaravelOpenApi\Factories\SchemaFactory;

class TaskFormSchema extends SchemaFactory implements Reusable
{
    /**
     * @return AllOf|OneOf|AnyOf|Not|Schema
     */
    public function build(): SchemaContract
    {
        return Schema::object('TaskForm')
            ->properties(
                Schema::string('parent_id')
                    ->description('Parent task ID')
                    ->default(null),
                Schema::string('status')
                    ->description('Task statuses')
                    ->enum(TaskStatusEnum::TODO, TaskStatusEnum::DONE),
                Schema::integer('priority')
                    ->description('Task priority')
                    ->minimum(1)
                    ->maximum(5),
                Schema::string('title')
                    ->description('Task title')
                    ->maximum(255),
                Schema::string('description')
                    ->description('Task description')
                    ->maximum(50000),
            );
    }
}
