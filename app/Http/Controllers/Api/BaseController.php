<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function sendResponse($data, $status = 'success' , $code = 200): JsonResponse
    {
        return response()->json(['data' => $data , 'status' => $status ] , $code);
    }

    public function sendError($data, $status = 'failed' , $code = 404): JsonResponse
    {
        return response()->json(['data' => $data , 'status' => $status ] , $code);
    }
}
