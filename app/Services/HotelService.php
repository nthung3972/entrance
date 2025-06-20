<?php

namespace App\Services;

use App\Models\Hotel;
use App\Repositories\HotelRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class HotelService
{
    public function __construct(
        public HotelRepository $hotelRepository,
    ) {}

    public function hotelList(int $id): LengthAwarePaginator
    {
        return $this->hotelRepository->hotelList($id);
    }

    public function getHotelById(int $hotel_id): ?Hotel
    {
        return $this->hotelRepository->getHotelById($hotel_id);
    }
}
