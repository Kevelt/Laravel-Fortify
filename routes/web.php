<?php

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

Route::get('/home', function () {
    return view('home');
})->middleware(['auth']);

//Client Routes
use App\Http\Controllers\ClientController;
Route::get('/client-register', [ClientController::class, 'register'])->middleware(['auth']);
Route::post('/client-register', [ClientController::class, 'registerAjax'])->middleware(['auth'])->name('register-client');
Route::get('/client-list', [ClientController::class, 'list'])->middleware(['auth']);
