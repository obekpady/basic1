<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admincontroller;
use App\Http\Controllers\Demo\DemoController;
use App\Http\Controllers\Home\HomeSlideController;
use App\Http\Controllers\Home\AboutController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::controller(DemoController::class)->group(function(){
    Route::get('/about', 'Index')->name('about.page')->middleware('check');
    Route::get('/contact', 'contactMethod')->name('contact.page');
});


// For Admin all Routes
Route::controller(Admincontroller::class)->group(function(){
    Route::get('/admin/logout', 'destroy')->name('admin.logout');
    Route::get('/admin/profile', 'profile')->name('admin.profile');
    Route::get('/edit/profile', 'Editprofile')->name('edit.profile');
    Route::get('/change/password', 'ChangePassword')->name('change.password');
    Route::post('/update/password', 'UpdatePassword')->name('update.password');
    Route::post('/store/profile', 'storeProfile')->name('store.profile');
   
});

//For HomeSliderController all routes
Route::controller(HomeSlideController::class)->group(function(){
    Route::get('/home/slide', 'HomeSlider')->name('home.slide');
    Route::post('/update/slide', 'UpdateSlider')->name('update.slide');
   
});
//About page all routes
Route::controller(AboutController::class)->group(function(){
    Route::get('/about/page', 'AboutPage')->name('about.page');
    Route::post('/update/about', 'UpdateAbout')->name('update.about');
    Route::get('/about', 'HomeAbout')->name('home.about');
    
   
});


Route::get('/', function () {
    return view('frontend.index');
});

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth','verified'])->name('dashboard');

require __DIR__.'/auth.php';