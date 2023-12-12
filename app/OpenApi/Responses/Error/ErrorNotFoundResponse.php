<?php

namespace App\OpenApi\Responses\Error;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class ErrorNotFoundResponse extends ResponseFactory implements Reusable
{
    public function build(): Response
    {
        return Response::notFound('ErrorNotFound')
            ->description('Not found response');
    }
}
