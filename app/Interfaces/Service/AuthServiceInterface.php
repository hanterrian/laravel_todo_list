<?php

declare(strict_types=1);

namespace App\Interfaces\Service;

use App\Data\LoginData;

interface AuthServiceInterface
{
    public function login(LoginData $data): string;

    public function logout(): void;
}
