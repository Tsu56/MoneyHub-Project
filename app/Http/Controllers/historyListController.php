<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class historyListController extends Controller
{
    //
    public function pageCalendar() {
        $user_transactions = Transaction::where('us_id', Auth::user()->id)->get();
        $user_id = Auth::user()->id;
        return view('MoneyHub.historyListCalendar', compact('user_transactions', 'user_id'));
    }

    public function pageResult(Request $request) {
        return $request;
        // return view('MoneyHub.historyListResult');
    }
}
