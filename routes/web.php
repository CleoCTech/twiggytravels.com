<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\GeneralContoller as GuestGeneralContoller;
use App\Http\Controllers\Admin\GeneralController as AdminGeneralController;
use App\Http\Controllers\Admin\DestinationCategoriesController as AdminDestinationCategoriesController;
use App\Http\Controllers\Admin\HolidaysController as AdminHolidaysController;
use App\Http\Controllers\Admin\PricesController as AdminPricesController;
use App\Http\Controllers\Admin\DestinationsController as AdminDestinationsController;
use App\Http\Controllers\Admin\FaqController as AdminFaqController;
use App\Http\Controllers\Admin\ReviewsController as AdminReviewsController;
use App\Http\Controllers\Admin\TestController as AdminTestController;
use App\Http\Controllers\Admin\BookingsController as AdminBookingsController;
use App\Http\Controllers\Admin\PackageController as AdminPackageController;
use App\Http\Controllers\Admin\SectionImagesController as AdminSectionImagesController;
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
Route::get('/local-destination/{slug}',[GuestGeneralContoller::class,'showDestination']);
Route::get('/package/{slug}',[GuestGeneralContoller::class,'showPackage']);
Route::get('/international-destination/{slug}',[GuestGeneralContoller::class,'showDestination']);
Route::get('/international-destinations',[GuestGeneralContoller::class,'internationalDestinations'])->name('international');
Route::get('/local-destinations',[GuestGeneralContoller::class,'localDestinations'])->name('local');
Route::get('/themed-holidays/{theme}',[GuestGeneralContoller::class,'themedHolidays'])->name('themed');
Route::get('/get-ratting/{id}',[GuestGeneralContoller::class,'getRatting']);
Route::get('/topbar-data',[GuestGeneralContoller::class,'topBarData']);
Route::get('/footer-data',[GuestGeneralContoller::class,'footerData']);

/**
 * Auth User
 */
Route::get('/dashboard',[GuestGeneralContoller::class,'dashboard']);
/***
 * Admin Routes
 */

Route::prefix('admin')->group(function () {
    Route::get('/dashboard',[AdminGeneralController::class,'dashboard'])->name('admin.dashboard');
    Route::get('/dashboard/statistics',[AdminGeneralController::class,'statistics'])->name('admin.statistics');
    Route::get('/dashboard/charts/{category}/{duration}',[AdminGeneralController::class,'chartsData'])->name('admin.charts');
    /***
     * DestinationCategories
     */
    Route::get('/destination-category',[AdminDestinationCategoriesController::class,'index'])->name('admin.destination-category');
    Route::get('/destination-category/create',[AdminDestinationCategoriesController::class,'create']);
    Route::get('/destination-category/show/{uuid}',[AdminDestinationCategoriesController::class,'show']);
    Route::get('/destination-category/edit/{uuid}',[AdminDestinationCategoriesController::class,'edit']);
    Route::post('/destination-category/store',[AdminDestinationCategoriesController::class,'store']);
    Route::delete('/destination-category/delete/{uuid}',[AdminDestinationCategoriesController::class,'destroy']);
    Route::get('/destination-category/report/{name}',[AdminDestinationCategoriesController::class,'report']);
    /***
     * HolidayCategories
     */
    Route::get('/holiday',[AdminHolidaysController::class,'index'])->name('admin.holiday');
    Route::get('/holiday/create',[AdminHolidaysController::class,'create']);
    Route::get('/holiday/show/{uuid}',[AdminHolidaysController::class,'show']);
    Route::get('/holiday/edit/{uuid}',[AdminHolidaysController::class,'edit']);
    Route::post('/holiday/store',[AdminHolidaysController::class,'store']);
    Route::delete('/holiday/delete/{uuid}',[AdminHolidaysController::class,'destroy']);
    Route::get('/holiday/report/{name}',[AdminHolidaysController::class,'report']);
    /***
     * PriceCategories
     */
    Route::get('/price',[AdminPricesController::class,'index'])->name('admin.price');
    Route::get('/price/create',[AdminPricesController::class,'create']);
    Route::get('/price/show/{uuid}',[AdminPricesController::class,'show']);
    Route::get('/price/edit/{uuid}',[AdminPricesController::class,'edit']);
    Route::post('/price/store',[AdminPricesController::class,'store']);
    Route::delete('/price/delete/{uuid}',[AdminPricesController::class,'destroy']);
    Route::get('/price/report/{name}',[AdminPricesController::class,'report']);
     /***
     * Destinations
     */
    Route::get('/destination',[AdminDestinationsController::class,'index'])->name('admin.destination');
    Route::get('/destination/create',[AdminDestinationsController::class,'create']);
    Route::get('/destination/show/{uuid}',[AdminDestinationsController::class,'show']);
    Route::get('/destination/edit/{uuid}',[AdminDestinationsController::class,'edit']);
    Route::post('/destination/store',[AdminDestinationsController::class,'store']);
    Route::delete('/destination/delete/{uuid}',[AdminDestinationsController::class,'destroy']);
    Route::get('/destination-category/report/{name}',[AdminDestinationsController::class,'report']);
     /***
     * Packages
     */
    Route::get('/package',[AdminPackageController::class,'index'])->name('admin.package');
    Route::get('/package/create',[AdminPackageController::class,'create']);
    Route::get('/package/show/{uuid}',[AdminPackageController::class,'show']);
    Route::get('/package/edit/{uuid}',[AdminPackageController::class,'edit']);
    Route::post('/package/store',[AdminPackageController::class,'store']);
    Route::delete('/package/delete/{uuid}',[AdminPackageController::class,'destroy']);
    Route::get('/package-category/report/{name}',[AdminPackageController::class,'report']);
     /***
     * Destinations
     */
    Route::get('/faq',[AdminFaqController::class,'index'])->name('admin.faq');
    Route::get('/faq/create',[AdminFaqController::class,'create']);
    Route::get('/faq/show/{uuid}',[AdminFaqController::class,'show']);
    Route::get('/faq/edit/{uuid}',[AdminFaqController::class,'edit']);
    Route::post('/faq/store',[AdminFaqController::class,'store']);
    Route::delete('/faq/delete/{uuid}',[AdminFaqController::class,'destroy']);
    Route::get('/faq/report/{name}',[AdminFaqController::class,'report']);
     /***
     * Reviews
     */
    Route::get('/review',[AdminReviewsController::class,'index'])->name('admin.review');
    Route::get('/review/create',[AdminReviewsController::class,'create']);
    Route::get('/review/show/{uuid}',[AdminReviewsController::class,'show']);
    Route::get('/review/edit/{uuid}',[AdminReviewsController::class,'edit']);
    Route::post('/review/store',[AdminReviewsController::class,'store']);
    Route::delete('/review/delete/{uuid}',[AdminReviewsController::class,'destroy']);
    Route::get('/review/report/{name}',[AdminReviewsController::class,'report']);
     /***
     * Bookings
     */
    Route::get('/bookings',[AdminBookingsController::class,'index'])->name('admin.bookings');
    Route::get('/bookings/create',[AdminBookingsController::class,'create']);
    Route::get('/bookings/show/{uuid}',[AdminBookingsController::class,'show']);
    Route::get('/bookings/edit/{uuid}',[AdminBookingsController::class,'edit']);
    Route::post('/bookings/store',[AdminBookingsController::class,'store']);
    Route::delete('/bookings/delete/{uuid}',[AdminBookingsController::class,'destroy']);
    Route::get('/bookings/report/{name}',[AdminBookingsController::class,'report']);
    /***
     *sectionimage
     */
    Route::get('/sectionimage',[AdminSectionImagesController::class,'index'])->name('admin.section-images');;
    Route::get('/sectionimage/search/{keyword}',[AdminSectionImagesController::class,'search']);
    Route::get('/sectionimage/create',[AdminSectionImagesController::class,'create']);
    Route::get('/sectionimage/show/{id}',[AdminSectionImagesController::class,'show']);
    Route::get('/sectionimage/edit/{id}',[AdminSectionImagesController::class,'edit']);
    Route::post('/sectionimage/store',[AdminSectionImagesController::class,'store']);
    Route::delete('/sectionimage/delete/{id}',[AdminSectionImagesController::class,'destroy']);
    /***
     * Client
     */
    // Route::get('/client',[AdminClientsController::class,'index']);
    // Route::get('/client/create',[AdminClientsController::class,'create']);
    // Route::get('/client/show/{uuid}',[AdminClientsController::class,'show']);
    // Route::get('/client/edit/{uuid}',[AdminClientsController::class,'edit']);
    // Route::post('/client/store',[AdminClientsController::class,'store']);
    // Route::delete('/client/delete/{uuid}',[AdminClientsController::class,'destroy']);
    /***
     * Test
     */
    Route::get('/test',[AdminTestController::class,'index'])->name('admin.tests');
});

//
Route::group([], __DIR__.'/system.php');
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
