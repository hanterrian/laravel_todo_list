<?php

namespace App\OpenApi\Responses;

use App\OpenApi\Schemas\TaskSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class TaskResponse extends ResponseFactory implements Reusable
{
    public function build(): Response
    {
        return Response::ok('TaskResponse')
            ->content(
                MediaType::json()->schema(TaskSchema::ref())
            )
            ->description('Successful response');
    }
}
