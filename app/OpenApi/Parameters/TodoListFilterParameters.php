<?php

namespace App\OpenApi\Parameters;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Parameter;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ParametersFactory;

class TodoListFilterParameters extends ParametersFactory
{
    /**
     * @return Parameter[]
     */
    public function build(): array
    {
        return [

            Parameter::query()
                ->name('status')
                ->description('Todo status')
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('priority')
                ->description('Todo priority')
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('title')
                ->description('Todo title')
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('description')
                ->description('Todo description')
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('sort')
                ->description('Todo list sort (?sort=-popularity,price)')
                ->required(false)
                ->schema(Schema::string()),

        ];
    }
}
