<?php

namespace App\Repositories;

use App\Models\Hotel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class HotelRepository
{
    public function hotelList(int $id): LengthAwarePaginator
    {
        $builder = Hotel::query();

        $builder->where('prefecture_id', $id);

        return $builder->paginate(config('constant.paginate'));
    }

    public function hasHotelsByPrefectureId(int|string|null $id): bool
    {
        return Hotel::where('prefecture_id', $id)->exists();
    }

    public function getHotelById(int $hotel_id): ?Hotel
    {
        return Hotel::find($hotel_id);
    }
}
