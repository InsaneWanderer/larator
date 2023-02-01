<?php

namespace App\Services;

use App\Enums\Advert\AdvertPlacementType;
use App\Enums\Advert\AdvertType;
use App\Enums\Sort\SortType;
use App\Models\Advert;
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

    public function index(?array $data = null)
    {
        dd($data);
        if ($data === null) $data = [];
        $user = Auth::user();
        $data = array_merge([
            "adverts" => (new AdvertRepository())->filtered($user?->id),
            "maxPayment" => ceil((new AdvertRepository())->maxPayment() / 1000),
            "types" => AdvertType::cases(),
            "placementTypes" => AdvertPlacementType::cases(),            
            "sortVariants" => ['payment', 'date'],
            "sortTypes" => SortType::cases(),"selectedType" => isset($filters['type']) ? $filters['type'] : null,
            "selectedType" => null,
            "selectedPlacementType" => null,
            "selectedSort" => null,
        ], $data);
        return view('adverts.index', $data);
    }

    public function list(array $filters = null)
    {
        $user = Auth::user();
        return to_route('adverts.index',  ["data" => [
            "adverts" => (new AdvertRepository())->filtered($user?->id, $filters),
            "selectedType" => isset($filters['type']) ? $filters['type'] : null,
            "selectedPlacementType" => isset($filters['placement_type']) ? $filters['placement_type'] : null,
            "selectedSort" => isset($filters['sort']) ? $filters['sort'] : null,
        ]]);
    }

    public function show(int $id)
    {
        $advert = Advert::with('user')->find($id);
        if (!$advert) {
            return abort('404');
        }

        return view("adverts.index");
    }
}