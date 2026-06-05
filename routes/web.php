<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\prosesController;
use App\Http\Controllers\viewController;
use App\Http\Controllers\userController;

// view
Route::get('/', [viewController::class, 'index']);
Route::get('/event', [viewController::class, 'event']);
Route::get('/about', [viewController::class, 'about']);
Route::get('/contact',[viewController::class, 'contact']);
Route::get('/forgot', [viewController::class, 'forgot']);
Route::post('/forgot', [userController::class, 'forgot']);
Route::get('/otp', [viewController::class,'otp']);
Route::post('/otp', [userController::class,'verifyForgot']);
Route::get('/resetpassword', [viewController::class,'resetPassword']);
Route::post('/resetpassword', [userController::class,'resetPassword']);
Route::get('/event/{id_with_slug}', [viewController::class, 'detailEvent'])->name('kegiatan.detail');
Route::get('/event/arsip/{tahun}/{bulan}', [viewController::class, 'arsipEvent']);

// otp
Route::get('/verify/{token}', [userController::class, 'verify']);

// login admin
Route::get('/login', [viewController::class, 'login']);
Route::post('/login', [userController::class, 'login']);
Route::post('/logout', [userController::class, 'logout']);
Route::prefix('/dashboard')->group(function(){
    Route::get('/', [viewController::class, 'dashboard']);
    Route::get('/user', [viewController::class, 'user']);
    Route::get('/user/tambah', [viewController::class, 'tambahUser']);
    Route::get('/user/edit/{id}', [viewController::class, 'editUser']);
    Route::post('/user/simpan', [userController::class,'addUser']);
    Route::post('/user/update/{id}', [userController::class,'updateUser']);
    Route::delete('/user/delete/{id}', [userController::class,'deleteUser']);
    Route::get('/event', [viewController::class, 'dashboardEvent']);
    Route::get('/event/tambah', [viewController::class, 'EventTambah']);
    Route::get('/event/edit/{id}', [viewController::class, 'EventEdit']);
    Route::delete('/event/delete/{event}', [prosesController::class, 'EventHapus']);
    Route::post('/event/update', [prosesController::class, 'EventUpdate']);
    Route::post('/event/simpan', [prosesController::class, 'EventSimpan']);
    Route::get('/profile', [viewController::class, 'profile']);
    Route::post('/profile/update', [prosesController::class, 'updateProfile']);
});