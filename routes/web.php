<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\BreakingNewsController;
use App\Http\Controllers\LiveStreamController;
use App\Http\Controllers\ReelController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\NewsAppController;
use App\Http\Controllers\WebConfigurationController;
use App\Http\Controllers\SocialConfigurationController;
use App\Http\Controllers\ContactConfigurationController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\AdController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MailConfigurationController;
use App\Http\Controllers\SurveyController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Frontend Routes
Route::get('/', [NewsAppController::class, 'index']);
Route::get('/categories', [NewsAppController::class, 'getCategories']);
Route::get('slider-details/{id}', [NewsAppController::class, 'getSliderDetails']);
Route::get('category-news/{id}', [NewsAppController::class, 'getNewsByCategory']);
Route::get('/latest-news', [NewsAppController::class, 'getLatestNews']);
Route::get('news-details/{id}', [NewsAppController::class, 'getNewsDetails']);
Route::post('search', [NewsAppController::class, 'searchNews']);
Route::get('/contact', [NewsAppController::class, 'contact']);

// Users Auth Routes
Route::get('user-login', [UserController::class, 'showUserLoginForm']);
Route::get('user-registration', [UserController::class, 'showUserRegistrationForm']);
Route::get('user/forgot-password', [UserController::class, 'showUserForgotPasswordForm']);
Route::get('user/verify-otp', [UserController::class, 'showUserVerifyOTPForm']);
Route::get('user/reset-password', [UserController::class, 'showUserResetPasswordForm']);
Route::get('user-profile', [UserController::class, 'showUserProfile']);

Route::get('pages/{slug}', [PageController::class, 'showDynamicPage']);
Route::post('/news/save-comment', [CommentController::class, 'saveComment']);

// Survey Route
Route::post('submit-vote', [SurveyController::class, 'submitVote']);

//Admin Auth Routes
Route::get('/admin', [AuthController::class, 'login']);
Route::post('login', [AuthController::class, 'authLogin']);
Route::get('logout', [AuthController::class, 'logout']);
Route::get('forgot-password', [AuthController::class, 'showForgotPasswordForm']);
Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
Route::get('reset/{remember_token}', [AuthController::class, 'showResetPasswordForm']);
Route::post('reset/{remember_token}', [AuthController::class, 'resetPassword']);

Route::group(['middleware' => 'admin'], function() {
    Route::get('admin/dashboard', [DashboardController::class, 'dashboard']);

    // Admin Routes
    Route::get('admin/list', [AdminController::class, 'adminList']);
    Route::get('admin/add', [AdminController::class, 'add']);
    Route::post('admin/add', [AdminController::class, 'insert']);
    Route::get('admin/edit/{id}', [AdminController::class, 'edit']);
    Route::post('admin/edit', [AdminController::class, 'update']);
    Route::get('admin/delete/{id}', [AdminController::class, 'delete']);

    // Users Routes
    Route::get('users/list', [UserController::class, 'userList']);
    Route::get('users/edit/{id}', [UserController::class, 'edit']);
    Route::post('users/edit', [UserController::class, 'update']);
    Route::get('users/delete/{id}', [UserController::class, 'delete']);

    // Language Routes
    Route::get('language/list', [LanguageController::class, 'languageList']);
    Route::get('language/add', [LanguageController::class, 'add']);
    Route::post('language/add', [LanguageController::class, 'insert']);
    Route::get('language/edit/{id}', [LanguageController::class, 'edit']);
    Route::post('language/edit', [LanguageController::class, 'update']);
    Route::get('language/delete/{id}', [LanguageController::class, 'delete']);

    // Breaking News Routes
    Route::get('breaking-news/list', [BreakingNewsController::class, 'breakingNewsList']);
    Route::get('breaking-news/add', [BreakingNewsController::class, 'add']);
    Route::post('breaking-news/add', [BreakingNewsController::class, 'insert']);
    Route::get('breaking-news/edit/{id}', [BreakingNewsController::class, 'edit']);
    Route::post('breaking-news/edit', [BreakingNewsController::class, 'update']);
    Route::get('breaking-news/delete/{id}', [BreakingNewsController::class, 'delete']);

    // Live Streaming Routes
    // Route::get('live-stream/list', [LiveStreamController::class, 'liveStreamList']);
    // Route::get('live-stream/add', [LiveStreamController::class, 'add']);
    // Route::post('live-stream/add', [LiveStreamController::class, 'insert']);
    // Route::get('live-stream/edit/{id}', [LiveStreamController::class, 'edit']);
    // Route::post('live-stream/edit', [LiveStreamController::class, 'update']);
    // Route::get('live-stream/delete/{id}', [LiveStreamController::class, 'delete']);

    // Reels Routes
    Route::get('reel/list', [ReelController::class, 'reelList']);
    Route::get('reel/add', [ReelController::class, 'add']);
    Route::post('reel/add', [ReelController::class, 'insert']);
    Route::get('reel/edit/{id}', [ReelController::class, 'edit']);
    Route::post('reel/edit', [ReelController::class, 'update']);
    Route::get('reel/delete/{id}', [ReelController::class, 'delete']);

    // Slider Routes
    Route::get('slider/list', [SliderController::class, 'sliderList']);
    Route::get('slider/add', [SliderController::class, 'add']);
    Route::get('categories/{languageId}', [SliderController::class, 'getCategoriesByLanguage']);
    Route::post('slider/add', [SliderController::class, 'insert']);
    Route::get('slider/edit/{id}', [SliderController::class, 'edit']);
    Route::post('slider/edit', [SliderController::class, 'update']);
    Route::get('slider/delete/{id}', [SliderController::class, 'delete']);

    // Category Routes
    Route::get('category/list', [CategoryController::class, 'categoryList']);
    Route::get('category/add', [CategoryController::class, 'add']);
    Route::post('category/add', [CategoryController::class, 'insert']);
    Route::get('category/edit/{id}', [CategoryController::class, 'edit']);
    Route::post('category/edit', [CategoryController::class, 'update']);
    Route::get('category/delete/{id}', [CategoryController::class, 'delete']);

    // Tag Routes
    Route::get('tag/list', [TagController::class, 'tagList']);
    Route::get('tag/add', [TagController::class, 'add']);
    Route::post('tag/add', [TagController::class, 'insert']);
    Route::get('tag/edit/{id}', [TagController::class, 'edit']);
    Route::post('tag/edit', [TagController::class, 'update']);
    Route::get('tag/delete/{id}', [TagController::class, 'delete']);

    // Location Routes
    Route::get('location/list', [LocationController::class, 'locationList']);
    Route::get('location/add', [LocationController::class, 'add']);
    Route::post('location/add', [LocationController::class, 'insert']);
    Route::get('location/edit/{id}', [LocationController::class, 'edit']);
    Route::post('location/edit', [LocationController::class, 'update']);
    Route::get('location/delete/{id}', [LocationController::class, 'delete']);

    // Page Routes
    Route::get('page/list', [PageController::class, 'pageList']);
    Route::get('page/add', [PageController::class, 'add']);
    Route::post('page/add', [PageController::class, 'insert']);
    Route::get('page/edit/{id}', [PageController::class, 'edit']);
    Route::post('page/edit', [PageController::class, 'update']);
    Route::get('page/delete/{id}', [PageController::class, 'delete']);

    // News Routes
    Route::get('news/list', [NewsController::class, 'newsList']);
    Route::get('news/add', [NewsController::class, 'add']);
    Route::get('categories/{languageId}', [NewsController::class, 'getCategoriesByLanguage']);
    Route::get('tags/{languageId}', [NewsController::class, 'getTagsByLanguage']);
    Route::post('news/add', [NewsController::class, 'insert']);
    Route::get('news/edit/{id}', [NewsController::class, 'edit']);
    Route::post('news/edit', [NewsController::class, 'update']);
    Route::get('news/delete/{id}', [NewsController::class, 'delete']);

    // Notification Routes
    Route::get('notification', [NotificationController::class, 'index']);
    Route::post('notification/send', [NotificationController::class, 'send']);
    
    // Survey Routes
    Route::get('survey/list', [SurveyController::class, 'surveyList']);
    Route::get('add-survey', [SurveyController::class, 'showAddSurveyForm']);
    Route::post('add-survey', [SurveyController::class, 'addSurvey']);
    Route::get('view-options/{id}', [SurveyController::class, 'viewOptions']);
    Route::post('add-option/{id}', [SurveyController::class, 'addOption']);
    Route::get('edit-survey/{id}', [SurveyController::class, 'showEditSurveyForm']);
    Route::put('update-survey/{id}', [SurveyController::class, 'updateSurvey']);
    Route::put('update-option/{id}', [SurveyController::class, 'updateOption']);
    Route::get('delete-option/{id}', [SurveyController::class, 'deleteOption']);
    Route::get('delete-survey/{id}', [SurveyController::class, 'deleteSurvey']);

    // Survey Routes
    // Route::get('survey/list', [SurveyController::class, 'surveyList']);
    // Route::get('survey/add', [SurveyController::class, 'add']);
    // Route::post('survey/add', [SurveyController::class, 'insert']);

    // Ad Spaces Routes
    Route::get('ad/list', [AdController::class, 'adList']);
    Route::post('ad/update', [AdController::class, 'updateAds']);

    // Email Routes
    Route::post('email/send', [EmailController::class, 'sendEmail']);
    Route::get('email/list', [EmailController::class, 'emailList']);
    Route::get('email/delete/{id}', [EmailController::class, 'delete']);

    // Settings Routes
    // Advertisement
    Route::get('settings/advertisement', [SettingsController::class, 'showAdvertisementForm']);
    Route::post('settings/advertisement/update', [SettingsController::class, 'updateAdvertisementInfo']);
    // Notification
    Route::get('settings/notification', [SettingsController::class, 'showNotificationSettingsForm']);
    Route::post('settings/notification/update', [SettingsController::class, 'updateNotificationSettings']);
    // General
    Route::get('settings/general', [SettingsController::class, 'showGeneralSettingsForm']);
    Route::post('settings/general/update', [SettingsController::class, 'updateGeneralSettings']);
    // Web Configuration
    Route::get('settings/web-configuration', [WebConfigurationController::class, 'showWebConfigurationForm']);
    Route::post('settings/web-configuration/update', [WebConfigurationController::class, 'updateWebConfiguration']);
    // Web Configuration
    Route::get('settings/mail-configuration', [MailConfigurationController::class, 'showMailConfigurationForm']);
    Route::post('settings/mail-configuration/update', [MailConfigurationController::class, 'updateMailConfiguration']);
    // Social Configuration
    Route::get('settings/social-configuration/list', [SocialConfigurationController::class, 'socialList']);
    Route::get('settings/social-configuration/add', [SocialConfigurationController::class, 'add']);
    Route::post('settings/social-configuration/add', [SocialConfigurationController::class, 'insert']);
    Route::get('settings/social-configuration/edit/{id}', [SocialConfigurationController::class, 'edit']);
    Route::post('settings/social-configuration/update', [SocialConfigurationController::class, 'update']);
    Route::get('settings/social-configuration/delete/{id}', [SocialConfigurationController::class, 'delete']);
    // Web Configuration
    Route::get('settings/contact-configuration', [ContactConfigurationController::class, 'showContactConfigurationForm']);
    Route::post('settings/contact-configuration/update', [ContactConfigurationController::class, 'updateContactConfiguration']);
});


// Route::group(['middleware' => 'user'], function() {
// });