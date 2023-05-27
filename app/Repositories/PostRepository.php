<?php

namespace App\Repositories;

use App\Common\Response;
use App\Http\Resources\v1\PostResource;
use App\Models\v1\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostRepository
{
    /**
     * Store post
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $post = Post::create([
                'user_id' => $request->user()->id,
                'title' => $request->title,
                'description' => $request->description
            ]);

            return Response::created('Post crated successfully!');
        } catch (\Exception $ex) {
            return Response::internalError('An error ocurred while saving the post: ' . $ex->getMessage());
        }
    }

    /**
     * Show post
     *
     * @param integer $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            $post = Post::firstWhere('id', $id);

            if ($post) {
                return Response::resource(new PostResource($post), 'post');
            }

            return Response::notFound('Post not found.');
        } catch (\Exception $ex) {
            return Response::internalError('An error ocurred while retrieving the post: ' . $ex->getMessage());
        }
    }
}
