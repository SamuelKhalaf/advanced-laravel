<?php

namespace App\Requests\User;

use App\Requests\BaseRequestFormApi;

class CreateUserValidator extends BaseRequestFormApi
{
    public function rules(): array
    {
        return [
            'name' => 'required|max:50' ,
            'email' => 'required|email|max:50|unique:users,email',
            'password' => 'required|min:6|max:60|confirmed'
        ];
    }

    public function authorized(): bool
    {
        return true;
    }
}
