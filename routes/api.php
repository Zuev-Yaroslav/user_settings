<?php

use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\UserController;
use App\Http\Middleware\AllowUpdateProfileSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResources([
    'users' => UserController::class,
    'profiles' => ProfileController::class
], ['except' => ['update']]);
Route::patch('/profiles/{profile}', [ProfileController::class, 'update'])->middleware(AllowUpdateProfileSettings::class);
Route::group(['prefix' => 'profiles'], function () {
    Route::get('/{profile}/send-verification-edit', [ProfileController::class, 'sendVerificationEdit']);
    Route::post('/{profile}/verify-to-edit', [ProfileController::class, 'verifyToEdit']);
});
