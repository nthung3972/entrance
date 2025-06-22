<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\HotelService;
use App\Services\PrefectureService;
use App\Services\UploadFileService;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\CreateHotelRequest;
use App\Http\Requests\SearchHotelsRequest;
use App\Http\Requests\UpdateHotelRequest;

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
                ->with('create-success', 'ホテルが正常に作成されました。');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'ホテルの作成中にエラーが発生しました。もう一度お試しください。']);
        }
    }

    public function search(): View
    {
        $prefectures = $this->prefectureService->getAllPrefectures();
        return view('admin.hotel-search', compact('prefectures'));
    }

    public function handleSearch(SearchHotelsRequest $request)
    {
        session()->put('search_data', $request->only(['hotel_name', 'prefecture_name_alpha']));

        return redirect()->route('hotel.result');
    }

    public function result()
    {
        try {
            $data = session('search_data', []);
            if (!empty($data['prefecture_name_alpha'])) {
                $prefecture = $this->prefectureService->getPrefectureByName($data['prefecture_name_alpha']);
                $data['prefecture_id'] = $prefecture->prefecture_id;
            }

            $searchResults = $this->hotelService->searchHotels($data);
            return View('admin.hotel-result', compact('searchResults', 'data'));
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'ホテルの検索中にエラーが発生しました。もう一度お試しください。']);
        }
    }

    public function formEdit($hotel_id)
    {
        try {
            $hotel = $this->hotelService->getHotelById($hotel_id);
            if (!$hotel) {
                return redirect()->back()->withErrors(['error' => '指定されたホテルが見つかりません。']);
            }

            $listPrefectures = $this->prefectureService->getAllPrefectures();

            return view('admin.hotel-update', compact('hotel', 'listPrefectures'));
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'ホテルの情報を取得中にエラーが発生しました。もう一度お試しください。']);
        }
    }

    public function update(UpdateHotelRequest $request, $hotel_id)
    {
        $uploadFile = null;
        try {
            $hotel = $this->hotelService->getHotelById($hotel_id);
            if (!$hotel) {
                return redirect()->back()->withErrors(['error' => '指定されたホテルが見つかりません。']);
            }

            if ($request->file('image')) {
                $uploadFile = $this->uploadFileService->uploadFile($request->file('image'));
            }

            $updateHotel = $this->hotelService->updateHotel($hotel_id, $request->only('prefecture_id', 'hotel_name'), $uploadFile);

            if (!$updateHotel) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['error' => 'ホテルの更新中にエラーが発生しました。もう一度お試しください。']);
            }

            return redirect()->route('hotel.detail', ['hotel_id' => $updateHotel->hotel_id])
                ->with('update-success', 'ホテルが正常に更新されました。');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'ホテルの更新中にエラーが発生しました。もう一度お試しください。']);
        }
    }

    public function delete($hotel_id)
    {
        try {
            $hotel = $this->hotelService->getHotelById($hotel_id);
            if (!$hotel) {
                return redirect()->back()->withErrors(['error' => '指定されたホテルが見つかりません。']);
            }

            $deleteHotel = $this->hotelService->deleteHotel($hotel_id);
            if ($deleteHotel) {
                $this->uploadFileService->deleteFile($hotel->file_path);
                return redirect()->back()->with('delete-success', 'ホテルが正常に削除されました。');
            }

            return redirect()->back()->withErrors(['delete-error' => 'ホテルの削除中にエラーが発生しました。もう一度お試しください。']);

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'ホテルの削除中にエラーが発生しました。もう一度お試しください。']);
        }
    }
}
