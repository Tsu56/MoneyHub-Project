<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\historyListController;
use App\Http\Controllers\homeController;
use App\Models\Transaction;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\transactionController;
use App\Http\Controllers\summarizeController;
use App\Http\Controllers\QrcodeController;

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
    Route::get('/MoneyHub/getSummarize', [summarizeController::class, "getSummarize"])->name('moneyhub.getsummarize');
    Route::post('/MoneyHub/getTransaction', [transactionController::class, "getAllTransaction"])->name('moneyhub.gettransaction');
    Route::get('/MoneyHub/noteIncome/{user_id}', [transactionController::class, "noteIncomeForm"])->name('moneyhub.noteincome');
    Route::get('/MoneyHub/noteExpense/{user_id}', [transactionController::class, "noteExpenseForm"])->name('moneyhub.noteexpense');
    Route::post('/MoneyHub/insertTransaction', [transactionController::class, "insertTransaction"])->name('moneyhub.inserttransaction');
    Route::get('MoneyHub/HistoryList', [historyListController::class , 'pageCalendar'])->name('moneyhub.historyList');
    Route::get('MoneyHub/HistoryList/Result', [historyListController::class, 'pageResult'])->name('moneyhub.historyListReuslt');
    Route::get('MoneyHub/HistoryList/getMonthTransaction', [historyListController::class, 'getMonthTransaction'])->name('moneyhub.historyListgetMonthTransaction');
    Route::get('MoneyHub/HistoryList/delTransaction', [historyListController::class, 'pageEdit'])->name('moneyhub.historyList.pageEdit');
    Route::get('MoneyHub/HistoryList/delTransaction', [historyListController::class, 'deleteTran'])->name('moneyhub.historyList.delTran');
    Route::get('MoneyHub/HistoryList/updateTransaction', [historyListController::class, 'updateTran'])->name('moneyhub.historyList.updateTran');
    Route::post('MoneyHub/HistoryList/Result', [historyListController::class, 'pageResult'])->name('moneyhub.historyListReuslt');
    Route::get('/MoneyHub/contact',[ContactController::class,'contact'])->name('moneyhub.contact');
    Route::post('/MoneyHub/contact', [ContactController::class, 'store'])->name('moneyhub.contact.store');
    Route::get('/MoneyHub/QrCode', [QrcodeController::class, "QR"])->name('moneyhub.Qrcode');
    Route::get('/MoneyHub/QrCodelink', [QrcodeController::class, "link"])->name('moneyhub.Qrcodelink');
    Route::get('/MoneyHub/about', [homeController::class, "about"])->name('moneyhub.about');
    
    Route::middleware([
        'admin'
        ])->group(function () {
            Route::get('/MoneyHub/Adminhome', [adminController::class, "index"])->name('moneyhub.admin');
            Route::get('/MoneyHub/delete/{user_id}', [adminController::class, "delete"])->name('moneyhub.deleteuser');
            Route::get('/MoneyHub/grantAdmin/{user_id}', [adminController::class, "grantAdmin"])->name('moneyhub.grantadmin');
    });
});