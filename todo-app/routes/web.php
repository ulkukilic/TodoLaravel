<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\TaskController;

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
          Route::get('login','showLoignForm')->name('login.form');
          Route::post('login','login')->name('login.submit'); // get  formu getiriyor Post ise formdan gelen veriyi isliyor 
          // Kayıt
          Route::get('register', 'showRegistrationForm')->name('register.form');
          Route::post('register', 'register')->name('register.submit');//Auth controller da bulunan fonskiyonlarin isimleri burda kullailir cagirilmasi icin
          // Cikis 
          Route::post('logout','logout')->name('logout');
 });

  Route::prefix('dash')->group(function(){ // AuthController giris yaptiktan sonra kullaniciyi hangi sayfaya gonderecegini belirler . Route ise bu paneli ziyaret etmeye hakkim var mi kontrol eder bir admin url den customer a gecemeye calisirsa 404 veya 403 hatasi alir bu kontrol edilir
          Route::get('customer',fn()=> view('dash.customer'))->name('dash.customer')->middleware('userType:1');
          Route::get('admin',fn()=> view('dash.admin'))->name('dash.admin')->middleware('userType:2');
 });


  Route::middleware(['auth'])->prefix('tasks')->name('tasks.')->controller(TaskController::class)->group(function(){
          Route::get('/','index')->name('index');
          Route::get('create','create')->name('create');
          Route::post('create','createStore')->name('store');
          Route::get('{id}/edit','edit')->name('edit');
          Route::put('{id}','update')->name('update');

 });
