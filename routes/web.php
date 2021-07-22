<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\ChangepasswordController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\OrderRequestController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Profile route
Route::get('/profile', [ProfileController::class, 'index']);
Route::get('/profile/edit', [ProfileController::class, 'edit']);
Route::patch('/profile/{profile}', [ProfileController::class, 'update']);
Route::get('/profile/change-password', [ChangepasswordController::class, 'index']);
Route::post('/profile/change-password', [ChangepasswordController::class, 'store']);
// Aditional profile
// Route::get('/profile/edit/specialty', [ProfileController::class, 'edit_specialty']);
// Route::patch('/profile/{profile}/specialty', [ProfileController::class, 'update_specialty']);


// Admin Route

Route::get('/account', [AccountController::class, 'index']);
Route::post('/account', [AccountController::class, 'store']);
Route::get('/account/login-history', [AccountController::class, 'login_history']);
Route::post('/account/enable-disable', [AccountController::class, 'enable_disable_account']);


// bi




// pt
Route::get('/notices', [NoticeController::class, 'index']);
Route::get('/notices/create', [NoticeController::class, 'create']);
Route::post('/notices', [NoticeController::class, 'store']);
Route::get('/notices/{notice}', [NoticeController::class, 'show']);
Route::get('/notices/{notice}/edit', [NoticeController::class, 'edit']);
Route::patch('/notices/{notice}', [NoticeController::class, 'update']);
Route::delete('/notices/{notice}', [NoticeController::class, 'destroy']);



// pr
Route::get('/requests', [OrderRequestController::class, 'index']);
// Approved request for pt & Sd user type only
Route::get('/requests/approved', [OrderRequestController::class, 'index_approved']);
Route::get('/requests/create', [OrderRequestController::class, 'create']);
Route::post('/requests', [OrderRequestController::class, 'store']);
Route::get('/requests/{request}', [OrderRequestController::class, 'show']);
Route::delete('/requests/{request}', [OrderRequestController::class, 'destroy']);
Route::post('/requests/pd/{request}', [OrderRequestController::class, 'pd_approve']);
Route::post('/requests/casher/{request}', [OrderRequestController::class, 'casher_approve']);
Route::post('/requests/sd/{request}', [OrderRequestController::class, 'sd_approve']);


// pd



// casher



// sd



// pac
