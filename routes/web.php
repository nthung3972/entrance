<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;

Route::group(['prefix' => '/'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
});
