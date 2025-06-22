<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\HotelController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminHotelController;
use Illuminate\Routing\Router;

Route::group(['prefix' => '/'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('{prefecture}/hotelist', [HotelController::class, 'hotelList'])->name('hotel.list');
    Route::get('hotel/{hotel_id}', [HotelController::class, 'hotelDetail'])->name('hotel.detail');

    Route::group(['prefix' => 'admin'], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('admin.index');
        Route::get('hotel/create', [AdminHotelController::class, 'formCreate'])->name('hotel.form.create');
        Route::post('hotel/create', [AdminHotelController::class, 'create'])->name('hotel.create');
        Route::get('hotel/search', [AdminHotelController::class, 'search'])->name('hotel.search');
        Route::post('hotel/search', [AdminHotelController::class, 'handleSearch'])->name('hotel.search.submit');
        Route::get('hotel/result', [AdminHotelController::class, 'result'])->name('hotel.result');
        Route::get('hotel/{hotel_id}/update', [AdminHotelController::class, 'formEdit'])->name('hotel.form.edit');
        Route::put('hotel/{hotel_id}/update', [AdminHotelController::class, 'update'])->name('hotel.update');
        Route::delete('hotel/{hotel_id}/delete', [AdminHotelController::class, 'delete'])->name('hotel.delete');
    });
});
