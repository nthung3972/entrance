<?php

namespace App\Services;

use App\Exceptions\ResourceNotFoundException;
use App\Repositories\BookingReposiroty;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class BookingService
{
    public function __construct(
        public BookingReposiroty $bookingRepository,
    ) {}

    public function searchBookings(array $filters): LengthAwarePaginator
    {
        $hasSearchCriteria = $this->hasValidFilters($filters);

        if ($hasSearchCriteria) {
            return $this->bookingRepository->searchWithFilters($filters);
        }

        return $this->getEmptyPaginator();
    }

    private function hasValidFilters(array $filters): bool
    {
        $searchFields = ['customer_name', 'customer_contact', 'checkin_time', 'checkout_time'];
        
        foreach ($searchFields as $field) {
            if (!empty($filters[$field])) {
                return true;
            }
        }
        
        return false;
    }

    private function getEmptyPaginator(): LengthAwarePaginator
    {
        return new \Illuminate\Pagination\LengthAwarePaginator(
            collect(),
            0,
            config('constant.paginate'),
            1,
            ['path' => request()->url(), 'pageName' => 'page']
        );
    }

    public function existsByHotelId(int $hotelId): bool
    {
        return $this->bookingRepository->existsByHotelId($hotelId);
    }

    public function deleteByHotelId(int $hotelId): int
    {
        return $this->bookingRepository->deleteByHotelId($hotelId);
    }
}
