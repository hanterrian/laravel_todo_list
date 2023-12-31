<?php

namespace App\OpenApi\Responses;

use App\OpenApi\Schemas\EmptySchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class FormTaskResponse extends ResponseFactory implements Reusable
{
    public function build(): Response
    {
        return Response::ok('FormTaskResponse')
            ->content(
                MediaType::json()->schema(EmptySchema::ref())
            )
            ->description('Successful response');
    }
}
