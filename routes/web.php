<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\GeneralContoller as GuestGeneralContoller;

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


/**
 * Guest
 */
Route::get('/',[GuestGeneralContoller::class,'home'])->name('home');
Route::post('/customer-ratting',[GuestGeneralContoller::class,'ratting'])->name('ratting');
Route::post('/customer-booking',[GuestGeneralContoller::class,'book'])->name('book');
Route::get('/tours',[GuestGeneralContoller::class,'tours'])->name('tours');
Route::get('/about-us',[GuestGeneralContoller::class,'aboutUs'])->name('about-us');
Route::get('/local-destination/{title}',[GuestGeneralContoller::class,'showDestination']);
Route::get('/international-destination/{title}',[GuestGeneralContoller::class,'showDestination']);
Route::get('/international-destinations',[GuestGeneralContoller::class,'internationalDestinations'])->name('international');
Route::get('/local-destinations',[GuestGeneralContoller::class,'localDestinations'])->name('local');
Route::get('/themed-holidays/{theme}',[GuestGeneralContoller::class,'themedHolidays'])->name('themed');
Route::get('/get-ratting/{id}',[GuestGeneralContoller::class,'getRatting']);
Route::get('/topbar-data',[GuestGeneralContoller::class,'topBarData']);
Route::get('/footer-data',[GuestGeneralContoller::class,'footerData']);

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return Inertia::render('Dashboard');
//     })->name('dashboard');
// });
