<?php

namespace App\OpenApi\RequestBodies;

use App\OpenApi\Schemas\LoginUserSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class LoginDataRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create('UserLogin')
            ->description('User login')
            ->content(
                MediaType::json()->schema(LoginUserSchema::ref())
            );
    }
}
