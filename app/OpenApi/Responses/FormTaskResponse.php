<?php

namespace App\OpenApi\Responses;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class FormTaskResponse extends ResponseFactory implements Reusable
{
    public function build(): Response
    {
        return Response::ok('FormTaskResponse')
            ->description('Successful response');
    }
}
