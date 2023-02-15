<?php

namespace App\Http\Controllers;

use App\Enums\Advert\AdvertPlacementType;
use App\Enums\Advert\AdvertType;
use App\Enums\Sort\SortType;
use App\Services\AdvertService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class AdvertController extends Controller
{
    public function index(Request $request) {

        // dd($request);
        $filters = $request->validate([
            'min_payment' => ['sometimes', 'nullable', 'integer', 'min:0'],
            'max_payment' => ['sometimes', 'nullable', 'integer', 'min:0'],
            'type' => ['sometimes', 'nullable', Rule::in(AdvertType::casesString())],
            'placement_type' => ['sometimes', 'nullable', Rule::in(AdvertPlacementType::casesString())],
            'sort' => ['sometimes', 'nullable', 'string'],
        ]);
        // dd($filters, $request->all(), $request->method());
        return (new AdvertService())->index($filters);
    }

    // public function filtindex(Request $request) {
        

    //     return (new AdvertService())->list($filters);
    // }

    public function create(Request $request)
    {
        $data = $request->validate([
            'type' => ['required', Rule::in(AdvertType::casesString())],
            'placement_type' => ['required', Rule::in(AdvertPlacementType::casesString())],
            'address' => ['required', 'string'],
            'description' => ['required', 'string'],
            'payment' => ['required', 'integer', 'min:0'],
            'square' => ['required', 'integer', 'min:0'],
            'images' => ['array'],
        ]);

        return (new AdvertService())->create($data);
    }

    public function createForm()
    {
        return view("adverts.form", ["advert" => null, "types" => AdvertType::cases(),
        "placementTypes" => AdvertPlacementType::cases()]);
    }

    public function show(int $id)
    {
        return (new AdvertService())->show($id);
    }
}
