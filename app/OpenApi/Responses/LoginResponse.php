<?php

namespace App\OpenApi\Responses;

use App\OpenApi\Schemas\LoginSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class LoginResponse extends ResponseFactory implements Reusable
{
    public function build(): Response
    {
        return Response::ok('LoginResponse')
            ->content(
                MediaType::json()->schema(LoginSchema::ref())
            )
            ->description('Empty content response');
    }
}
