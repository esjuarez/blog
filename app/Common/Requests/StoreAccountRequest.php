<?php

namespace App\Common\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class StoreAccountRequest
{
    /**
     * Validate store account request
     *
     * @param Request $request
     * @return Validator
     */
    public function validate(Request $request): Validator
    {
        return FacadesValidator::make($request->all(), [
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|max:80|unique:users,email',
            'password' => 'required|string|confirmed',
            'password_confirmation' => 'required|string'
        ]);
    }
}
