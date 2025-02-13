<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ThirdPartyController extends BaseController
{
    public function index()
    {
        $response = Http::get('https://www.hawyatshipping.com/api/get-ports/Sea-533');

        return $this->sendResponse($response->json());
    }
}
