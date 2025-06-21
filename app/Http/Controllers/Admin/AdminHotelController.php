<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\HotelService;
use App\Services\PrefectureService;
use App\Services\UploadFileService;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\CreateHotelRequest;

class AdminHotelController extends Controller
{
    public function __construct(
        public HotelService $hotelService,
        public PrefectureService $prefectureService,
        public UploadFileService $uploadFileService
    ) {}

    public function formCreate(): View
    {
        $listPrefectures = $this->prefectureService->getAllPrefectures();

        return view('admin.create-hotel', compact('listPrefectures'));
    }

    public function create(CreateHotelRequest $request)
    {
        $uploadFile = null;
        try {
            if ($request->file('images')) {
                $uploadFile = $this->uploadFileService->uploadFile($request->file('images'));
            }

            $createHotel = $this->hotelService->createHotel($request->only('prefecture_id', 'hotel_name'), $uploadFile);

            if (!$createHotel) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['error' => 'ホテルの作成中にエラーが発生しました。もう一度お試しください。']);
            }

            return redirect()->route('hotel.detail', ['hotel_id' => $createHotel->hotel_id])
                ->with('success', 'ホテルが正常に作成されました。');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'ホテルの作成中にエラーが発生しました。もう一度お試しください。']);
        }
    }
}
