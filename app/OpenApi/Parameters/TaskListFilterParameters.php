<?php

namespace App\OpenApi\Parameters;

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
                ->schema(Schema::string()),
            Parameter::query()
                ->name('priority')
                ->description('Task priority')
                ->required(false)
                ->schema(Schema::string()),
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
                ->description('Task list sort (?sort=-popularity,price)')
                ->required(false)
                ->schema(Schema::string()),

        ];
    }
}
