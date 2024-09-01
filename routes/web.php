<?php

use App\Presentation\Http\Controllers\ProfileController;
use App\Presentation\Http\Middleware\AllowUpdateProfile;
use App\Presentation\Http\Middleware\IsNeedSendVerificationToUpdateProfile;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return redirect()->route('profiles.index');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::group(['prefix' => 'profiles'], function () {
    Route::get('/', [ProfileController::class, 'index'])->name('profiles.index');
    Route::get('/{profile}', [ProfileController::class, 'show'])->name('profiles.show');
    Route::get('/{profile}/edit', [ProfileController::class, 'edit'])->name('profiles.edit')->middleware(AllowUpdateProfile::class);
    Route::patch('/{profile}', [ProfileController::class, 'update'])->name('profiles.update')->middleware(AllowUpdateProfile::class);
    Route::get('/{profile}/send-verification', [ProfileController::class, 'showVerificationSending'])->middleware(IsNeedSendVerificationToUpdateProfile::class)->name('profiles.show_verification_sending');
    Route::post('/{profile}/send-verification', [ProfileController::class, 'sendVerificationNotification'])->middleware(IsNeedSendVerificationToUpdateProfile::class)->name('profiles.send_verification_notification');
    Route::get('/{profile}/verify', [ProfileController::class, 'verify'])->middleware(IsNeedSendVerificationToUpdateProfile::class);
});

require __DIR__.'/auth.php';
