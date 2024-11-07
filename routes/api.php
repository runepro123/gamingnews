<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\Api\DeviceTokenController;
use App\Http\Controllers\Api\SettingsController;
use App\Http\Controllers\Api\ReelController;
use App\Http\Controllers\Api\SurveyController;
use App\Http\Controllers\Api\AdController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\PageController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Search API
Route::match(['get', 'post'], 'search', [NewsController::class, 'searchNews']);

// Category API
Route::get('categories/{id?}', [CategoryController::class, 'getCategory']);

// Videos APIs
Route::get('videos', [NewsController::class, 'getVideos']);
Route::get('videos/{id}', [NewsController::class, 'getVideoById']);

// Reels APIs
Route::get('reels', [ReelController::class, 'getReels']);
Route::get('reels/{id}', [ReelController::class, 'getReelsById']);
Route::post('reel/increment-views', [ReelController::class,'incrementReelViews']);
Route::post('reel/increment-favorite', [ReelController::class,'incrementReelFavorite']);

// News API
Route::get('news', [NewsController::class, 'getNews']);
Route::get('news/{id}', [NewsController::class, 'getNewsById']);
Route::get('news/category/{category_id}', [NewsController::class, 'getNewsByCategory']);
Route::get('recent-news', [NewsController::class, 'getRecentNews']);
Route::get('popular-news', [NewsController::class, 'getPopularNews']);
Route::post('news/increment-views', [NewsController::class,'incrementNewsViews']);
Route::post('news/increment-favorite', [NewsController::class,'incrementNewsFavorite']);

// Slider API
Route::get('slider', [SliderController::class, 'getSlider']);
Route::get('slider/{id}', [SliderController::class, 'getSliderById']);
Route::get('slider/category/{category_id}', [SliderController::class, 'getSliderByCategory']);
Route::post('slider/increment-views', [SliderController::class,'incrementSliderViews']);
Route::post('slider/increment-favorite', [SliderController::class,'incrementSliderFavorite']);

// Pages API
Route::get('pages', [PageController::class, 'getPages']);
Route::get('pages/{slug}', [PageController::class, 'getPagesContent']);

// Survey APIs
Route::get('survey', [SurveyController::class, 'getSurvey']);
Route::post('submit-vote', [SurveyController::class, 'submitVote']);

// Device Token API
Route::post('device-token/update', [DeviceTokenController::class, 'updateDeviceToken']);

// Settings API
Route::get('advertisement', [SettingsController::class, 'getAdvertisementDetails']);
Route::get('notification-settings', [SettingsController::class, 'getNotificationSettingsDetails']);
Route::get('general-settings', [SettingsController::class, 'getGeneralSettingsDetails']);

Route::get('ad', [AdController::class, 'getAd']);

Route::middleware('auth:sanctum')->group(function () {
    // User API
    Route::get('user', [UserController::class, 'getUser']);
    Route::post('update-user-info', [UserController::class, 'updateUserInfo']);

    // News API
    Route::get('news/favorite/{id}', [NewsController::class,'favorite']);

    // Slider API
    Route::get('slider/favorite/{id}', [SliderController::class,'favorite']);

    // Comment API
    Route::post('save-comment', [CommentController::class, 'saveComment']);

});
