<?php

declare(strict_types=1);

namespace App\Services;

use App\Interfaces\Service\AuthServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthService implements AuthServiceInterface
{
    public function login(Request $request): string
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
            'remember_me' => ['boolean'],
        ]);

        if (!Auth::attempt($request->only(['email', 'password']))) {
            throw new ValidationException('Wrong email or password');
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');

        return $tokenResult->plainTextToken;
    }

    public function logout(Request $request): void
    {
        $request->user()->tokens()->delete();
    }
}
