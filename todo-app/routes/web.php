<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;

// — Cache temizleme
Route::get('/clrall', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('config:cache');
    Artisan::call('route:clear');
    Artisan::call('optimize');
    echo "Cache temizlendi!";
});
// Ana sayfaya gelen istekleri login ekranına yönlendir
 Route::get('/', fn() => redirect()->route('login.form'));


 Route::controller(AuthController::class)->group(function (){
          //Giris ve Anasayfa
          Route::
 })