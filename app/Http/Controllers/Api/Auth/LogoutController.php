<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Interfaces\Service\AuthServiceInterface;
use App\OpenApi\Responses\DummyResponse;
use Illuminate\Http\JsonResponse;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

/**
 * This class handles the logout functionality for a user.
 *
 * Class LogoutController
 * @package App\Http\Controllers\Api\Auth
 *
 * @property AuthServiceInterface $authService The instance of AuthServiceInterface.
 */
#[OpenApi\PathItem]
class LogoutController extends Controller
{
    /**
     * Class constructor.
     *
     * @param  AuthServiceInterface  $authService  The instance of AuthServiceInterface.
     *
     * @return void
     */
    public function __construct(
        private readonly AuthServiceInterface $authService
    ) {
    }

    /**
     * Logout user
     *
     * @return JsonResponse The JSON response with the generated message.
     */
    #[OpenApi\Operation(tags: ['user'], method: 'POST')]
    #[OpenApi\Response(factory: DummyResponse::class)]
    public function __invoke()
    {
        $this->authService->logout();

        return response()->json([]);
    }
}
