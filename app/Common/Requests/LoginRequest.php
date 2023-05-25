<?php

namespace App\Common\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class LoginRequest
{
    /**
     * Validate login request
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validate(Request $request): Validator
    {
        return FacadesValidator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);
    }
}
