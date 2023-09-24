<?php

use App\Http\Controllers\homeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\transactionController;
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
});

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
    Route::get('/MoneyHub/noteIncome/{user_id}', [transactionController::class, "noteIncomeForm"])->name('moneyhub.noteincome');
    Route::get('/MoneyHub/noteExpense/{user_id}', [transactionController::class, "noteExpenseForm"])->name('moneyhub.noteexpense');
    Route::post('/MoneyHub/insertTransaction', [transactionController::class, "insertTransaction"])->name('moneyhub.inserttransaction');
});
