<?php

namespace App\Http\Controllers;

use App\Enums\Advert\AdvertPlacementType;
use App\Enums\Advert\AdvertType;
use App\Enums\Sort\SortType;
use App\Services\AdvertService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class AdvertController extends Controller
{
    public function index(Request $request) {
        $filters = $request->validate([
            'minPayment' => ['sometimes', 'nullable', 'integer', 'min:0'],
            'maxPayment' => ['sometimes', 'nullable', 'integer', 'min:0'],
            'type' => ['sometimes', 'nullable', new Enum(AdvertType::class)],
            'sortByPayment' => ['sometimes', 'nullable', new Enum(SortType::class)],
            'sortByDate' => ['sometimes', 'nullable', new Enum(SortType::class)],
        ]);

        return (new AdvertService())->list($filters);
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'type' => ['required', new Enum(AdvertType::class)],
            'placement_type' => ['required', new Enum(AdvertPlacementType::class)],
            'address' => ['required', 'string'],
            'description' => ['required', 'string'],
            'payment' => ['required', 'integer', 'min:0'],
            'square' => ['required', 'integer', 'min:0'],
        ]);

        return (new AdvertService())->create($data);
    }

    public function show(int $id)
    {
        return (new AdvertService())->show($id);
    }
}
