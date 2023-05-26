<?php

namespace App\Repositories;

use App\Common\Response;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountRepository
{
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
}
