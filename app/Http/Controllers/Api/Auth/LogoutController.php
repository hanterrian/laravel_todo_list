<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class LogoutController extends Controller
{
    /**
     * Logout user
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    #[OpenApi\Operation(tags: ['user'], method: 'POST')]
    public function __invoke(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }
}
