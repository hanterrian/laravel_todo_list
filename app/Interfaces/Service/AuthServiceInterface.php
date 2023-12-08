<?php

declare(strict_types=1);

namespace App\Interfaces\Service;

use Illuminate\Http\Request;

interface AuthServiceInterface
{
    public function login(Request $request): string;

    public function logout(Request $request): void;
}
