<?php

declare(strict_types=1);

namespace App\Data;

use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Data;

/**
 * User login DTO
 */
class LoginData extends Data
{
    public function __construct(
        #[Required, StringType, Max(255), Email, Exists('users', 'email')]
        public string $email,
        #[Required, StringType, Max(255)]
        public string $password
    ) {
    }
}
