<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\Auth\LoginResource;
use App\Http\Resources\Auth\RegisterResource;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    use ApiResponse;

    /**
     * Register a new user
     * @unauthenticated
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());

        return $this->successResponse(new RegisterResource($user), 'User created successfully', 201);
    }

    /**
     * Log in the user
     * @unauthenticated
     */
    public function login(LoginRequest $request)
    {
        if (!$token = JWTAuth::attempt($request->validated())) {
            return $this->errorResponse("Invalid credentials", 401);
        }

        return $this->successResponse(new LoginResource(['token' => $token]));
    }

    /**
     * Get authenticated user details
     */
    public function user()
    {
        return $this->successResponse(auth()->user());
    }

    /**
     * Refresh token
     * @return JsonResponse
     */
    public function refresh()
    {
        try {
            $newToken = JWTAuth::parseToken()->refresh();
            return $this->successResponse([
                'token' => $newToken,
            ]);
        } catch (JWTException $e) {
            return $this->errorResponse(
                "Token could not be refreshed " . $e->getMessage(),
                401
            );
        }
    }

    /**
     * Logout the user
     */
    public function logout()
    {
        auth()->logout();

        return $this->successResponse(['message' => 'Successfully logged out']);
    }

}
