<?php

use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\UserController;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

/** modules links */
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [UserController::class,'userTeams'])->name('dashboard');
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard/users', [UserController::class,'users'])->name('dashboard.users');
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard/teams', [UserController::class,'teams'])->name('dashboard.teams');

Route::middleware(['auth:sanctum', 'verified'])->get('/get-all-users', [UserController::class,'getUsers'])->name('getUsers');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard/extensions', function () {
    return Inertia::render('Extensions/Index');
})->name('extensions.index');

Route::get('/language/{language}', function ($language) {
    Session()->put('locale', $language);
    Session()->forget('modules');
    return redirect()->back();
})->name('language');

Route::get('/proba', function(Illuminate\Http\Request $request){

 $pepe = $request->user()->getAuthIdentifier();

    return [\Illuminate\Support\Facades\Auth::user(), $pepe];
})->middleware('auth');
