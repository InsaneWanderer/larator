<?php

namespace App\Services;

use App\Enums\Advert\AdvertPlacementType;
use App\Enums\Advert\AdvertType;
use App\Enums\Sort\SortType;
use App\Models\Advert;
use App\Models\Media;
use App\Repositories\AdvertRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

        if (isset($data['images'])) {
            $mediaData = [];
            foreach ($data['images'] as $image) {
                $name = "ad-{$advert->id}-" . $image->getClientOriginalName();
                $image->move(public_path() . "/img/start_images/", $name);
                $mediaData[] = [
                    "mediaable_type" => Advert::class,
                    "mediaable_id" => $advert->id,
                    "file_name" => "storage/adverts/{$advert->id}/images/{$name}",
                ];
            }
            Media::insert($mediaData);
        }

        return to_route('adverts.index');
    }

    public function index(?array $filters)
    {
        $user = Auth::user();
        return view('adverts.index', [
            "maxPayment" => ceil((new AdvertRepository())->maxPayment() / 1000),
            "types" => AdvertType::cases(),
            "placementTypes" => AdvertPlacementType::cases(),            
            "sortVariants" => ['payment', 'date'],
            "sortTypes" => SortType::cases(),"selectedType" => isset($filters['type']) ? $filters['type'] : null,
            "adverts" => (new AdvertRepository())->filtered($user?->id, $filters),
            "selectedMax" => isset($filters['max_payment']) ? $filters['max_payment'] : null,
            "selectedMin" => isset($filters['min_payment']) ? $filters['min_payment'] : null,
            "selectedType" => isset($filters['type']) ? $filters['type'] : null,
            "selectedPlacementType" => isset($filters['placement_type']) ? $filters['placement_type'] : null,
            "selectedSort" => isset($filters['sort']) ? $filters['sort'] : null,
        ]);
    }

    public function list(array $filters = null)
    {
        $user = Auth::user();
        return to_route('adverts.index',  );
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