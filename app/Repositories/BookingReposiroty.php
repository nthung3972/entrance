<?php

namespace App\Repositories;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class BookingReposiroty
{
    public function searchWithFilters(array $filters)
    {
        $query = Booking::query();

        if (!empty($filters['customer_name'])) {
            $query->where('customer_name', 'like', '%' . $filters['customer_name'] . '%');
        }

        if (!empty($filters['customer_contact'])) {
            $query->where('customer_contact', 'like', '%' . $filters['customer_contact'] . '%');
        }

        if (!empty($filters['checkin_time'])) {
            $checkinTime = str_replace('T', ' ', $filters['checkin_time']) . ':00';
            $query->where('checkin_time', '>=', $checkinTime);
        }

        if (!empty($filters['checkout_time'])) {
            $checkoutTime = str_replace('T', ' ', $filters['checkout_time']) . ':00';
            $query->where('checkout_time', '<=', $checkoutTime);
        }

        return $query->paginate(config('constant.paginate'));
    }

    public function existsByHotelId(int $hotelId): bool
    {
        return Booking::where('hotel_id', $hotelId)->exists();
    }

    public function deleteByHotelId(int $hotelId): int
    {
        return Booking::where('hotel_id', $hotelId)->delete();
    }

    public function searchBookings($request): LengthAwarePaginator
    {
        $query = Booking::query();

        if ($request->has('hotel_id')) {
            $query->where('hotel_id', $request->input('hotel_id'));
        }

        if ($request->has('customer_name')) {
            $query->where('customer_name', 'like', '%' . $request->input('customer_name') . '%');
        }

        if ($request->has('booking_date')) {
            $query->whereDate('booking_date', $request->input('booking_date'));
        }

        return $query->paginate(10);
    }
}
