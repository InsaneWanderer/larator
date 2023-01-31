<?php

namespace App\Repositories;

use App\Enums\Advert\AdvertType;
use App\Enums\Sort\SortType;
use App\Models\Advert;
use Illuminate\Database\Eloquent\Collection;

class AdvertRepository
{
    public function create(array $data) : Advert
    {
        $advert = Advert::create($data);
        return $advert;
    }

    public function update(Advert $advert, array $data) : void
    {
        $advert->update($data);
    }

    public function getById(int $id) : Advert
    {
        return Advert::find($id);
    }

    public function maxPayment() : int
    {
        return Advert::orderByDesc('payment')
            ->first()
            ?->payment ?? 0;
    }

    public function filtered(int $userId = null, array $filters = null) : Collection
    {
        $query = Advert::query();

        if ($userId !== null) {
            $query->whereNot("user_id", $userId);
        }

        if (isset($filters['minPayment']) || isset($filters['maxPayment'])) {
            $minPayment = empty($filters) ? $filters['minPayment'] : null;
            $maxPayment = empty($filters) ? $filters['maxPayment'] : null;
            $query = $this->filtByPayment($query, $minPayment, $maxPayment);
        }

        if (isset($filters['type'])) {
            $query = $this->filtByType($query, $filters['type']);
        }

        if (isset($filters['sortByPayment'])) {
            $query = $this->sort($query, "payment", $filters['sortByPayment']);
        }
        elseif (isset($filters['sortByDate'])) {
            $query = $this->sort($query, "updated_at", $filters['sortByPayment']);
        }

        return $query->get();
    }

    private function filtByPayment($query, int $minPayment, int $maxPayment)
    {
        $minPayment = $minPayment ?? 0;
        if ($maxPayment === null) {
            $maxPayment = Advert::orderByDesc('payment')
                ->first()
                ?->payment;
        }

        return $query->whereBetween('payment', [$minPayment, $maxPayment]);
    }

    private function filtByType($query, AdvertType $type)
    {
        return $query->where('type', $type->name);
    }

    private function sort($query, string $column, SortType $sortType)
    {
        return match ($sortType) {
            SortType::Asc => $query->orderBy($column),
            SortType::Desc => $query->orderByDesc($column),
        };
    }
}