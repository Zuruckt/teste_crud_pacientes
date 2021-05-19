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

Route::group(['prefix' => 'pacients'], function () {
    Route::get('/', [PacientController::class, 'getAllPacients'])->name('get-pacients');
    Route::post('/', [PacientController::class, 'postPacient'])->name('post-pacient');
    Route::delete('/{id}', [PacientController::class, 'deletePacient'])->name('delete-pacient');
});
