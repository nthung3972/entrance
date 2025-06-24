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

    public function createHotel(array $data, ?string $uploadFile): Hotel
    {
        $request = array_merge($data, array('file_path' =>$uploadFile));
        return $this->hotelRepository->createHotel($request);
    }

    public function searchHotels(array $data): LengthAwarePaginator
    {
        return $this->hotelRepository->searchHotels($data);
    }

    public function updateHotel(int $hotel_id, array $data, ?string $uploadFile): Hotel
    {
        if ($uploadFile) {
            $request = array_merge($data, array('file_path' => $uploadFile));
        } else {
            $request = $data;
        }
        return $this->hotelRepository->updateHotel($hotel_id, $request);
    }

    public function deleteHotel(int $hotel_id): bool
    {
        return $this->hotelRepository->deleteHotel($hotel_id);
    }
}
