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

    public function createHotel(array $request): Hotel
    {
        return Hotel::create($request);
    }

    public function searchHotels(array $data): LengthAwarePaginator
    {
        $builder = Hotel::with('prefecture');

        if (!empty($data['hotel_name'])) {
            $builder->where('hotel_name', 'like', '%' . $data['hotel_name'] . '%');
        }

        if (!empty($data['prefecture_id'])) {
            $builder->where('prefecture_id', $data['prefecture_id']);
        }

        return $builder->paginate(config('constant.paginate'));
    }

    public function updateHotel(int $hotel_id, array $request): Hotel
    {
        $hotel = Hotel::findOrFail($hotel_id);
        $hotel->update($request);
        
        return $hotel;
    }

    public function deleteHotel(int $hotel_id): bool
    {
        $hotel = Hotel::findOrFail($hotel_id);
        return $hotel->delete();
    }
}
