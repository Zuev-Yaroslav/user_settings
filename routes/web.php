<?php

use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AllowUpdateProfileSettings;
use Illuminate\Foundation\Application;
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
    return redirect()->route('profile.index');
//    return Inertia::render('Welcome', [
//        'canLogin' => Route::has('login'),
//        'canRegister' => Route::has('register'),
//        'laravelVersion' => Application::VERSION,
//        'phpVersion' => PHP_VERSION,
//    ]);
});

//Route::get('/dashboard', function () {
//    return Inertia::render('Dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::group(['prefix' => 'profiles'], function () {
    Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/{profile}', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/{profile}/edit', [ProfileController::class, 'edit'])->name('profile.edit')->middleware(AllowUpdateProfileSettings::class);

});
