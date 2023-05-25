<?php

namespace App\Http\Controllers;

use App\Common\Response;

class UnauthorizedRequestController extends Controller
{
    public function __invoke()
    {
        return Response::unauthorized();
    }
}
