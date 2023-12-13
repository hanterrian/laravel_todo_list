<?php

declare(strict_types=1);

namespace App\Interfaces\Service;

use App\Data\LoginData;

/**
 * Service to authenticate user
 */
interface AuthServiceInterface
{
    /**
     * Login user
     *
     * @param  LoginData  $data  Login data DTO
     * @return string
     */
    public function login(LoginData $data): string;

    /**
     * Logout user
     *
     * @return void
     */
    public function logout(): void;
}
