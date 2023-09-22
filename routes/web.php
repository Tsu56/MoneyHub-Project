<?php

use App\Http\Controllers\homeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\incomeController;
use App\Http\Controllers\summarizeController;

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
    return view('welcome');
})->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/MoneyHub', [homeController::class, "index"])->name('moneyhub.indexhome');
    Route::get('/MoneyHub/summarize', [summarizeController::class, "index"])->name('moneyhub.indexsummarize');
    Route::get('/MoneyHub/noteIncome/{user_id}', [incomeController::class, "noteIncomeForm"])->name('moneyhub.noteincome');
});
