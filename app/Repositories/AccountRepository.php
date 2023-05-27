<?php

namespace App\Repositories;

use App\Common\Response;
use App\Http\Resources\v1\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountRepository
{
    /**
     * Create user account
     *
     * @param Request $request
     * @param string $role
     * @return JsonResponse
     */
    public function store(Request $request, string $role = 'publisher'): JsonResponse
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $role,
            ]);

            return Response::createdResource(
                $user->createToken($request->password)->plainTextToken,
                'token',
                'Account created successfully!'
            );
        } catch (\Exception $ex) {
            return Response::internalError('An error ocurred while creating the account: ' . $ex->getMessage());
        }
    }

    /**
     * Get logged user
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getUser(Request $request): JsonResponse
    {
        try {
            return Response::resource(new UserResource($request->user()), 'user');
        } catch (\Exception $ex) {
            return Response::internalError("An error ocurred while getting user's data: " . $ex->getMessage());
        }
    }
}
