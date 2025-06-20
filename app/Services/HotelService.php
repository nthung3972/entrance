<?php

namespace App\Services;

use App\Repositories\HotelRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class HotelService
{
    public function __construct(
        public HotelRepository $hotelRepository,
    ) {}

    public function getAllHotels(int $id): LengthAwarePaginator
    {
        try {
            return $this->hotelRepository->getAllHotels($id);
        } catch (Exception $e) {
            throw new Exception('Error fetching hotels: ' . $e->getMessage());
        }
    }
}
