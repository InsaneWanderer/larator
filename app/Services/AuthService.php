<?php

namespace App\Services;

use App\Repositories\AuthRepository;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function auth(array $data)
    {
        $user = (new AuthRepository())->auth($data);
        if (!$user) {
            return back()->with(['error' => "Неверные логин или пароль"]);
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
        $user = (new AuthRepository())->registrate($data);

        Auth::login($user, true);
        return to_route('adverts.index');
    }
}