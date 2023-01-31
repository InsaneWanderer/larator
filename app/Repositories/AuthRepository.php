<?php

namespace App\Repositories;

use App\Models\User;

class AuthRepository
{
    public function registrate(array $data) : User
    {
        return User::create($data);
    }

    public function auth(array $data) : User
    {
        return User::where('email', $data['email'])
            ->where('password', $data['password'])
            ->first();
    }
}