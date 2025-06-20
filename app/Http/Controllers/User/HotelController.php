<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Prefecture;
use App\Services\HotelService;
use App\Services\PrefectureService;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function __construct(
        public HotelService $hotelService,
        public PrefectureService $prefectureService,
    ) {
    }

    public function hotelList(string $prefecture)
    {
        $listPrefectures = $this->prefectureService->getAllPrefectures();

        $prefectureModel = $this->prefectureService->getPrefectureByName($prefecture);

        $hotels = $this->hotelService->getAllHotels($prefectureModel->prefecture_id);
        
        return view('user.hotel-list', [
            'listPrefectures' => $listPrefectures,
            'hotels' => $hotels,
            'currentPrefecture' => $prefecture,
            'prefectureModel' => $prefectureModel 
        ]);
    }
}
