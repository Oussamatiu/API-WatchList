<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [UserController::class , 'register']);
Route::post('/login', [UserController::class , 'login']);
Route::post('/logout',[UserController::class , 'logout'])->middleware('auth:sanctum');
Route::get('/user',[UserController::class, 'infos'])->middleware('auth:sanctum');

Route::resource('movies',MovieController::class)->middleware('auth:sanctum');


