<?php

use App\Http\Controllers\PacientController;
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

Route::get('/', fn() => view('welcome'));
Route::get('/token', fn() => csrf_token()); //used for postman testing, will be removed

Route::group(['prefix' => 'pacients'], function () {
    Route::get('/', [PacientController::class, 'getAllPacients'])->name('get-pacients');
    Route::get('/{id}', [PacientController::class, 'getPacient'])->name('get-pacient');
    Route::post('/', [PacientController::class, 'postPacient'])->name('post-pacient');
    Route::put('/{id}', [PacientController::class, 'putPacient'])->name('put-pacient');
    Route::delete('/{id}', [PacientController::class, 'deletePacient'])->name('delete-pacient');
});
