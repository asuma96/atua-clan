<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('pages.user');
});
Route::get('/quiz', function () {
    return view('pages.quiz');
});
Route::post('user', [\App\Http\Controllers\UserController::class, 'create'])->name('create');
