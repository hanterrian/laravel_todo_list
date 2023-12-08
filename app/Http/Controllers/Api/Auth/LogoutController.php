<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Interfaces\Service\AuthServiceInterface;
use Illuminate\Http\Request;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class LogoutController extends Controller
{
    public function __construct(
        private readonly AuthServiceInterface $authService
    ) {
    }

    /**
     * Logout user
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    #[OpenApi\Operation(tags: ['user'], method: 'POST')]
    public function __invoke(Request $request)
    {
        $this->authService->logout($request);

        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }
}
