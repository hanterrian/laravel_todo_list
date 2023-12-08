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

use /**
 * Class Controller
 *
 * @package App\Http\Controllers
 *
 * This class represents the base controller for all controllers in the application.
 * It provides common functionality and services that are required by multiple controllers.
 */
    App\Http\Controllers\Controller;
use /**
 * Interface AuthServiceInterface
 *
 * This interface defines the methods that a concrete AuthService class must implement.
 * AuthService handles user authentication and authorization functionality.
 */
    App\Interfaces\Service\AuthServiceInterface;
use Illuminate\Http\JsonResponse;
use /**
 * Class Request
 *
 * The Request class represents an incoming HTTP request in the Laravel framework.
 * It provides methods to access the HTTP headers, query parameters, request body, and other request related information.
 *
 * @package Illuminate\Http
 */
    Illuminate\Http\Request;
use /**
 * This file contains the definition of the OpenApi attribute classes for Laravel.
 *
 * @package Vyuldashev\LaravelOpenApi\Attributes
 */
    Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

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
    public function __invoke(Request $request)
    {
        return response()->json([
            'accessToken' => $this->authService->login($request),
        ]);
    }
}
