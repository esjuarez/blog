<?php

namespace App\Http\Controllers\v1;

use App\Common\Requests\StorePostRequest;
use App\Common\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\PostResource;
use App\Models\v1\Post;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * @var StorePostRequest
     */
    private StorePostRequest $postRequest;

    private PostRepository $postRepository;

    /**
     * Construct
     *
     * @param StorePostRequest $postRequest
     */
    public function __construct(StorePostRequest $postRequest, PostRepository $postRepository)
    {
        $this->postRequest = $postRequest;
        $this->postRepository = $postRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $this->postRequest->validate($request);

        if ($validator->fails()) {
            return Response::badRequest('The provided data is invalid.', $validator->errors()->all());
        }

        return $this->postRepository->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return $this->postRepository->show($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        //
    }
}
