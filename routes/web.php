<?php

use Illuminate\Http\Response;
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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

Route::get('/files', [App\Http\Controllers\FileUploadController::class, 'index']);
Route::post('files/add', [App\Http\Controllers\FileUploadController::class, 'store']);
Route::post('files/delete/{id}', [App\Http\Controllers\FileUploadController::class, 'destroy']);





