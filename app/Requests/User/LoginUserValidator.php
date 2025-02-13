<?php

namespace App\Requests\User;

use App\Requests\BaseRequestFormApi;

class LoginUserValidator extends BaseRequestFormApi
{
    public function rules(): array
    {
        return [
            'email' => 'required|email|max:50|exists:users,email',
            'password' => 'required|max:60'
        ];
    }

    public function authorized(): bool
    {
        return true;
    }
}
