<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/auth/register', [\App\Http\Controllers\AuthController::class, 'register'])->name('login');
Route::post('/auth/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('register');
Route::group(['middleware' => 'auth'] , function (){
    Route::resource('/trainers', App\Http\Controllers\TrainerController::class)->middleware('RoleId');

});
