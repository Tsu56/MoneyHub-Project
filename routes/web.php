<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\historyListController;
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
    Route::get('/MoneyHub/summarize/{user_id}', [summarizeController::class, "index"])->name('moneyhub.indexsummarize');
    Route::post('/MoneyHub/getSummarize', [summarizeController::class, "getSummarize"])->name('moneyhub.getsummarize');
    Route::get('/MoneyHub/noteIncome/{user_id}', [transactionController::class, "noteIncomeForm"])->name('moneyhub.noteincome');
    Route::get('/MoneyHub/noteExpense/{user_id}', [transactionController::class, "noteExpenseForm"])->name('moneyhub.noteexpense');
    Route::post('/MoneyHub/insertTransaction', [transactionController::class, "insertTransaction"])->name('moneyhub.inserttransaction');
    Route::get('MoneyHub/HistoryList', [historyListController::class , 'pageCalendar'])->name('moneyhub.historyList');
    Route::post('MoneyHub/HistoryList/Result', [historyListController::class, 'pageResult'])->name('moneyhub.historyListReuslt');
    Route::get('/MoneyHub/contact',[ContactController::class,'contact'])->name('moneyhub.contact');
});
