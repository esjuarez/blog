<?php

namespace App\Common;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class Response
{
    /**
     * Ok Response
     *
     * @param string $message
     * @return JsonResponse
     */
    public static function ok(string $message = 'Ok'): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message
        ], HttpFoundationResponse::HTTP_OK);
    }

    /**
     * Return resource
     *
     * @param mixed $resource
     * @param string $name
     * @return JsonResponse
     */
    public static function resource(mixed $resource, string $name = 'data'): JsonResponse
    {
        return response()->json([
            'success' => true,
            $name => $resource
        ], HttpFoundationResponse::HTTP_OK);
    }

    /**
     * Resource created response
     *
     * @param string $message
     * @return JsonResponse
     */
    public static function created($message = 'Created successfully!'): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message
        ], HttpFoundationResponse::HTTP_CREATED);
    }

    /**
     * Delete request
     *
     * @return JsonResponse
     */
    public static function deleted(): JsonResponse
    {
        return response()->json([], HttpFoundationResponse::HTTP_NO_CONTENT);
    }

    /**
     * Resouce not found
     *
     * @param string $message
     * @return JsonResponse
     */
    public static function notFound(string $message = 'Resource not found'): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message
        ], HttpFoundationResponse::HTTP_NOT_FOUND);
    }

    /**
     * Bad request
     *
     * @param string $message
     * @param [type] $errors
     * @return JsonResponse
     */
    public static function badRequest(string $message = 'Bad request', $errors = null): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $message
        ];

        if ($errors) {
            $response['errors'] = $errors;
        }

        return response()->json($response, HttpFoundationResponse::HTTP_BAD_REQUEST);
    }

    /**
     * Unauthorized request
     *
     * @param string $message
     * @return JsonResponse
     */
    public static function unauthorized(string $message = 'Unauthorized action'): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message
        ], HttpFoundationResponse::HTTP_UNAUTHORIZED);
    }

    /**
     * Internal server error response
     *
     * @param string $message
     * @return JsonResponse
     */
    public static function internalError(string $message = 'Internal Server Error'): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message
        ], HttpFoundationResponse::HTTP_INTERNAL_SERVER_ERROR);
    }
}
