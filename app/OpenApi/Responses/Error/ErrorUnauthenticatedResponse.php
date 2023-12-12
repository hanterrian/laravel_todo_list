<?php

namespace App\OpenApi\Responses\Error;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class ErrorUnauthenticatedResponse extends ResponseFactory implements Reusable
{
    public function build(): Response
    {
        return Response::unauthorized('ErrorUnauthorized')
            ->description('Unauthorized response');
    }
}
