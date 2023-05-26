<?php

namespace App\Http\Controllers\v1;

use App\Common\Requests\StoreAccountRequest;
use App\Common\Response;
use App\Http\Controllers\Controller;
use App\Repositories\AccountRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * @var StoreAccountRequest
     */
    private StoreAccountRequest $accountRequest;

    /**
     * @var AccountRepository
     */
    private AccountRepository $accountRepository;

    public function __construct(StoreAccountRequest $accountRequest, AccountRepository $accountRepository)
    {
        $this->accountRequest = $accountRequest;
        $this->accountRepository = $accountRepository;
    }

    /**
     * Create account
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validator = $this->accountRequest->validate($request);

        if ($validator->fails()) {
            return Response::badRequest(
                'The provided data is invalid.',
                $validator->errors()->all()
            );
        }

        return $this->accountRepository->store($request);
    }
}
