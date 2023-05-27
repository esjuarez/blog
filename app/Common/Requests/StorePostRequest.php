<?php

namespace App\Common\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class StorePostRequest
{
    /**
     * Validate post store request
     *
     * @param Request $request
     * @return Validator
     */
    public function validate(Request $request): Validator
    {
        return FacadesValidator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string'
        ]);
    }
}
