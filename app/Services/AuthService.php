<?php

namespace App\Services;

use App\Repositories\AuthRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function auth(array $data)
    {
        $user = (new AuthRepository())->auth($data);
        if (!($user && Hash::check($data['password'], $user->password))) {
            return back()->with(['errors' => ["Неверные логин или пароль"]]);
        }

        Auth::login($user, true);

        return to_route('adverts.index');
    }

    public function logout()
    {
        Auth::logout();
        return to_route('adverts.index');
    }

    public function registrate(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        $user = (new AuthRepository())->registrate($data);

        Auth::login($user, true);
        return to_route('adverts.index');
    }
}