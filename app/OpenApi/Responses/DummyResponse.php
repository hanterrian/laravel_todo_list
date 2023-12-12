<?php

namespace App\OpenApi\Responses;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class DummyResponse extends ResponseFactory implements Reusable
{
    public function build(): Response
    {
        return Response::ok('DummyResponse')
            ->content(
                MediaType::json()
            )
            ->description('Empty content response');
    }
}
