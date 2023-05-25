<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Common\Requests\LoginRequest;
use App\Common\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * @var LoginRequest
     */
    private LoginRequest $loginRequest;

    public function __construct(LoginRequest $loginRequest)
    {
        $this->loginRequest = $loginRequest;
    }

    /**
     * Login
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $validator = $this->loginRequest->validate($request);
        if ($validator->fails()) {
            return Response::badRequest('The provided data is invalid', $validator->errors()->all());
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return Response::badRequest('The provided credentials are incorrect.');
        }

        return Response::resource($user->createToken($request->password)->plainTextToken, 'token');
    }

    /**
     * Logout
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();

        return Response::ok('You have logged out successfully!');
    }
}
