<?php

namespace App\Services;

use App\Repositories\AdvertRepository;
use Illuminate\Support\Facades\Auth;

class AdvertService
{
    public function create(array $data)
    {
        $user = Auth::user();
        if (!$user) {
            return to_route('login');
        }

        $data['user_id'] = $user->id;
        
        $advert = (new AdvertRepository())->create($data);

        return to_route('adverts.show', ['advert' => $advert]);
    }

    public function list(array $filters = null)
    {
        $user = Auth::user();
        return to_route('adverts.index', ["adverts" => (new AdvertRepository())->filtered($user?->id, $filters)]);
    }
}