<?php

namespace App\Http\Controllers\User;

use App\Exceptions\ValidationException;
use App\Http\Controllers\Controller;
use App\Services\HotelService;
use App\Services\PrefectureService;
use App\Http\Requests\HotelListByPrefectureRequest;
use Illuminate\View\View;

class HotelController extends Controller
{
    public function __construct(
        public HotelService $hotelService,
        public PrefectureService $prefectureService,
    ) {}

    public function hotelList(string $prefecture)
    {
        $listPrefectures = collect();
        try {
            $listPrefectures = $this->prefectureService->getAllPrefectures();
            $prefectureModel = $this->prefectureService->getPrefectureByName($prefecture);

            if (!$prefectureModel) {
                return view('user.home', [
                    'listPrefectures' => $listPrefectures,
                    'hotels' => collect(),
                    'currentPrefecture' => ''
                ])->withErrors(['prefecture' => '都道府県が見つかりません。']);
            }

            $hotels = $this->hotelService->hotelList($prefectureModel->prefecture_id);

            return view('user.home', [
                'listPrefectures' => $listPrefectures,
                'hotels' => $hotels,
                'currentPrefecture' => $prefecture,
                'prefectureModel' => $prefectureModel
            ]);

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'エラーが発生しました。もう一度お試しください。']);
        }
    }

    public function hotelDetail(int $hotel_id): View
    {
        $hotel = null;
        $errors = [];
        try {
            $hotel = $this->hotelService->getHotelById($hotel_id);

            if (!$hotel) {
                throw new ValidationException('ホテルが見つかりません。');
            }

        } catch (ValidationException $e) {
            $errors = ['error' => $e->getMessage()];
        } catch (\Exception $e) {
            $errors = ['error' => 'エラーが発生しました。もう一度お試しください。'];
        }

        return view('user.hotel_detail', [
            'hotel' => $hotel
        ])->withErrors($errors);
    }
}
