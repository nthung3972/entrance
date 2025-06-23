<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Services\BookingService;

class DashboardController extends Controller
{
    public function __construct(
        public BookingService $bookingService,
    ) {}

    public function index(): View
    {
        return view('admin.dashboard');
    }
}
