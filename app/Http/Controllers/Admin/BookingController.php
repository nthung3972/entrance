<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\BookingService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookingController extends Controller
{
    public function __construct(
        public BookingService $bookingService
    ) {}

    public function search(Request $request): View
    {
        $bookings = $this->bookingService->searchBookings($request->all());
        return view('admin.booking-search', compact('bookings'));
    }
}
