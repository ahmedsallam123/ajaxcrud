<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserDataController;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/', function () {
    return view('welcome');
});


Route::get('/users', function () {
    return view('routes.users');
});


Route::get('/posts', function () {
    return view('routes.posts');
});


Route::get('/userdata', [UserDataController::class, 'index']);
Route::post('/userdata/store', [UserDataController::class, 'store'])->name('userdata.store');
Route::get('/userdata/all', [UserDataController::class, 'fetchAll']);
Route::post('/userdata/update/{id}', [UserDataController::class, 'update']);
Route::delete('/userdata/delete/{id}', [UserDataController::class, 'destroy']);
