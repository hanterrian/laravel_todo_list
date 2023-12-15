<?php

namespace App\OpenApi\RequestBodies;

use App\OpenApi\Schemas\TaskFormSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class TaskDataRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create('TaskData')
            ->description('Task form data')
            ->content(
                MediaType::formUrlEncoded()->schema(TaskFormSchema::ref())
            );
    }
}
