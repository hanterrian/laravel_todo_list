<?php

declare(strict_types=1);

/**
 * Class LoginController
 *
 * This class handles the authentication of a user.
 *
 * @package App\Http\Controllers\Api\Auth
 */

namespace App\Http\Controllers\Api\Auth;

use App\Data\LoginData;
use App\Http\Controllers\Controller;
use App\Interfaces\Service\AuthServiceInterface;
use App\OpenApi\RequestBodies\LoginDataRequestBody;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

/**
 * This class handles the authenticating functionality for a user.
 *
 * Class LoginController
 * @package App\Http\Controllers\Api\Auth
 *
 * @property AuthServiceInterface $authService The instance of AuthServiceInterface.
 */
#[OpenApi\PathItem]
class LoginController extends Controller
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
     * Login user
     *
     * @param  Request  $request  The incoming request object.
     * @return JsonResponse The JSON response with the generated access token.
     */
    #[OpenApi\Operation(tags: ['user'], method: 'POST')]
    #[OpenApi\RequestBody(factory: LoginDataRequestBody::class)]
    public function __invoke(LoginData $data)
    {
        return response()->json([
            'accessToken' => $this->authService->login($data),
        ]);
    }
}
