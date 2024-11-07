<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\PasswordResetController;
use App\Http\Controllers\Api\Auth\DeleteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LogoutController::class, 'logout'])->middleware(['auth:sanctum']);
// Reset Password Routes
Route::post('send-otp-email', [PasswordResetController::class, 'sendOtpEmail']);
Route::post('verify-otp', [PasswordResetController::class, 'verifyOtp']);
Route::post('change-password', [PasswordResetController::class, 'changePassword']);
Route::get('delete/{id}', [DeleteController::class, 'delete']);
