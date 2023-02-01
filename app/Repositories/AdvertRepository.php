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

        if (isset($filters['min_payment']) || isset($filters['max_payment'])) {
            $minPayment = isset($filters['min_payment']) ? $filters['min_payment'] : null;
            $maxPayment = isset($filters['max_payment']) ? $filters['max_payment'] : null;
            $query = $this->filtByPayment($query, $minPayment, $maxPayment);
        }

        if (isset($filters['type'])) {

            $query = $this->filtByType($query, AdvertType::fromName($filters['type']));
        }

        if (isset($filters['sort'])) {
            $sort = explode("-", $filters['sort']);
            $type = SortType::fromName($sort[1]);
            if ($sort[0] == 'payment') {
                $query = $this->sort($query, "payment", $type);
            }
            elseif ($sort[0] == 'date') {
                $query = $this->sort($query, "updated_at", $type);
            }
        }
        

        return $query->get();
    }

    private function filtByPayment($query, ?int $minPayment, ?int $maxPayment)
    {
        $minPayment = $minPayment ?? 0;
        if ($maxPayment == null) {
            $maxPayment = $this->maxPayment();
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