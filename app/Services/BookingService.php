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
}
