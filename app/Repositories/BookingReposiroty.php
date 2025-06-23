<?php

namespace App\Repositories;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class BookingReposiroty
{
    public function hotelList(int $id): LengthAwarePaginator
    {
        $builder = Booking::query();

        $builder->where('prefecture_id', $id);

        return $builder->paginate(config('constant.paginate'));
    }
}
