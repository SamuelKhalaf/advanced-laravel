<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Requests\User\CreateUserValidator;
use App\Requests\User\LoginUserValidator;
use App\Services\UserService;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends BaseController
{
    public UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(CreateUserValidator $createUserValidator)
    {
        // validation
        if (!empty($createUserValidator->getErrors())){
            return response()->json($createUserValidator->getErrors() , 422);
        }
        //create new user
        $user = $this->userService->createUser($createUserValidator->all());
        $data['token'] = $user->createToken('AppName')->plainTextToken;
        $data['user'] = $user;

        return $this->sendResponse($data);
    }

    public function login(LoginUserValidator $loginUserValidator)
    {
        if (!empty($loginUserValidator->getErrors())){
            return response()->json($loginUserValidator->getErrors(),422);
        }

        $request = $loginUserValidator->all();
        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])){
            $user = Auth::user();
            $data['token'] = $user->createToken('AppName')->plainTextToken;
            $data['name'] = $user->name;

            return $this->sendResponse($data);
        }else{
            return $this->sendError(['msg' => 'unAuthorized User'],'failed' , 401);
        }
    }
}
