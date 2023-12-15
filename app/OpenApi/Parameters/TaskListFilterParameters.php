<?php

declare(strict_types=1);

namespace App\OpenApi\Parameters;

use App\Enums\TaskStatusEnum;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Parameter;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ParametersFactory;

class TaskListFilterParameters extends ParametersFactory
{
    /**
     * @return Parameter[]
     */
    public function build(): array
    {
        return [

            Parameter::query()
                ->name('status')
                ->description('Task status')
                ->required(false)
                ->schema(Schema::string()->enum(TaskStatusEnum::TODO, TaskStatusEnum::DONE)),

            Parameter::query()
                ->name('priority')
                ->description('Task priority')
                ->required(false)
                ->schema(Schema::integer()->minimum(1)->maximum(5)),

            Parameter::query()
                ->name('title')
                ->description('Task title')
                ->required(false)
                ->schema(Schema::string()),

            Parameter::query()
                ->name('description')
                ->description('Task description')
                ->required(false)
                ->schema(Schema::string()),

            Parameter::query()
                ->name('sort')
                ->description('Task list sort (?sort=-priority,createdAt)')
                ->required(false)
                ->schema(Schema::string()),

        ];
    }
}
