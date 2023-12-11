<?php

declare(strict_types=1);

namespace App\Services;

use App\Data\LoginData;
use App\Interfaces\Service\AuthServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthService implements AuthServiceInterface
{
    public function __construct(
        private readonly Request $request
    ) {
    }

    public function login(LoginData $data): string
    {
        if (!Auth::attempt($data->toArray())) {
            throw ValidationException::withMessages([
                'email' => 'Wrong email or password',
            ]);
        }

        $user = $this->request->user();
        $tokenResult = $user->createToken('Personal Access Token');

        return $tokenResult->plainTextToken;
    }

    public function logout(): void
    {
        $this->request->user()->tokens()->delete();
    }
}
