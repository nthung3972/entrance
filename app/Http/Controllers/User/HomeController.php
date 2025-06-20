<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\PrefectureService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct(
        public PrefectureService $prefectureService,
    ) {
    }

    public function index(): View
    {
        $listPrefectures = $this->prefectureService->getAllPrefectures();
        
        return view('user.home', [
            'listPrefectures' => $listPrefectures,
            'hotels' => collect(),
            'currentPrefecture' => ''
        ]);
    }
}
