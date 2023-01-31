<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function registrate(Request $request)
    {
        $data = $request->validate([
            'surname' => ['required', 'string'],
            'name' => ['required', 'string'],
            'patronymic' => ['sometimes', 'string'],
            'phone' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'confirmed'],
        ]);
        return (new AuthService())->registrate($data);
    }

    public function auth(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string']
        ]);
        return (new AuthService())->auth($data);
    }

    public function logout()
    {
        return (new AuthService)->logout();
    }
}
