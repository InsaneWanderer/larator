<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthRepository
{
    public function registrate(array $data) : User
    {
        return User::create($data);
    }

    public function auth(array $data) : ?User
    {
        return User::where('email', $data['email'])
            ->first();
    }
}