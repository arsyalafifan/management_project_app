<?php

use App\Http\Controllers\master\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

    Route::get('sarpras-dashboard', function() {
        return view('dashboard');
    })->name('sarpras-dashboard');

    //User 
    Route::put('user/resetpassword/{id}', [UserController::class, 'resetpassword'])->name('user.resetpassword');
    Route::get('user/password', [UserController::class, 'password'])->name('user.password');
    Route::post('user/password', [UserController::class, 'storeubahpassword'])->name('user.password.save');
    Route::resource('user', UserController::class);
    
});
