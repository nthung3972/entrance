<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookingController extends Controller
{
    public function search(Request $request): View
    {
        $query = Booking::query();

        $hasSearchCriteria = false;

        if ($request->filled('booking_id')) {
            $query->where('booking_id', 'like', '%' . $request->booking_id . '%');
            $hasSearchCriteria = true;
        }

        if ($request->filled('hotel_id')) {
            $query->where('hotel_id', 'like', '%' . $request->hotel_id . '%');
            $hasSearchCriteria = true;
        }

        if ($request->filled('customer_name')) {
            $query->where('customer_name', 'like', '%' . $request->customer_name . '%');
            $hasSearchCriteria = true;
        }

        if ($request->filled('customer_contact')) {
            $query->where('customer_contact', 'like', '%' . $request->customer_contact . '%');
            $hasSearchCriteria = true;
        }

        if ($request->filled('checkin_time')) {
            // Tìm booking có checkin_time >= thời gian được chọn
            $checkinTime = str_replace('T', ' ', $request->checkin_time) . ':00';
            $query->where('checkin_time', '>=', $checkinTime);
            $hasSearchCriteria = true;
        }

        if ($request->filled('checkout_time')) {
            // Tìm booking có checkout_time <= thời gian được chọn
            $checkoutTime = str_replace('T', ' ', $request->checkout_time) . ':00';
            $query->where('checkout_time', '<=', $checkoutTime);
            $hasSearchCriteria = true;
        }

        // Chỉ thực hiện query khi có điều kiện search
        if ($hasSearchCriteria) {
            $bookings = $query->paginate(10);
        } else {
            // Trả về paginator rỗng để consistent với view
            $bookings = new \Illuminate\Pagination\LengthAwarePaginator(
                collect(), // empty collection
                0, // total
                10, // per page
                1, // current page
                ['path' => request()->url(), 'pageName' => 'page']
            );
        }

        return view('admin.booking-search', compact('bookings'));
    }
}
