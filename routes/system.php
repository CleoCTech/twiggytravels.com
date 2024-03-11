<?php
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\System\AttachmentsController as SystemAttachmentsController;
use App\Http\Controllers\System\CompanyInformationController as SystemCompanyInformationController;
use App\Http\Controllers\System\SocialMediasController as SystemSocialMediasController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\System\UsersContoller;
/***
 * Default System Routes
 */
Route::prefix('system')->group(function () {
    /***
     * Company Information
     */
    Route::get('/company-information',[SystemCompanyInformationController::class,'index'])->name('system.company');;
    Route::get('/company-information/show/{uuid}',[SystemCompanyInformationController::class,'show']);
    Route::get('/company-information/edit/{uuid}',[SystemCompanyInformationController::class,'edit']);
    Route::post('/company-information/store',[SystemCompanyInformationController::class,'store']);
    /***
     * Social Media
     */
    Route::get('/social-media',[SystemSocialMediasController::class,'index'])->name('system.social');
    Route::get('/social-media/create',[SystemSocialMediasController::class,'create']);
    Route::get('/social-media/show/{uuid}',[SystemSocialMediasController::class,'show']);
    Route::get('/social-media/edit/{uuid}',[SystemSocialMediasController::class,'edit']);
    Route::post('/social-media/store',[SystemSocialMediasController::class,'store']);
    Route::delete('/social-media/delete/{uuid}',[SystemSocialMediasController::class,'destroy']);
    Route::get('/social-media/report/{name}',[SystemSocialMediasController::class,'report']);

    /***
     * User Management
     */
    Route::get('/user',[UsersContoller::class,'index'])->name('system.user');
    Route::get('/user/create',[UsersContoller::class,'create']);
    Route::get('/user/show/{uuid}',[UsersContoller::class,'show']);
    Route::get('/user/edit/{uuid}',[UsersContoller::class,'edit']);
    Route::post('/user/store',[UsersContoller::class,'store']);
    Route::delete('/user/delete/{uuid}',[UsersContoller::class,'destroy']);
    Route::get('/user/report/{name}',[UsersContoller::class,'report']);


    /***
     * Admin Users
     */
    /***
     * User Roles
     */
    /***
     * System Actions
     */
    /***
     * General Setups
     */
     /***
     * Attachment
     */
    Route::get('/attachment/index/{tableName}/{recordId}',[SystemAttachmentsController::class,'index']);
    Route::get('/attachment/show/{uuid}',[SystemAttachmentsController::class,'show']);
    Route::post('/attachment/store',[SystemAttachmentsController::class,'store']);
    Route::delete('/attachment/delete/{uuid}',[SystemAttachmentsController::class,'destroy']);
    /***
     * Data Import
     */

});
/**
 * Other
 */
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    return redirect('/');
});
//create a symlink to storage folder
Route::get('/storage-link', function() {
    Artisan::call('storage:link');
    return redirect('/');
});
