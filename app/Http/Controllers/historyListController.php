<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class historyListController extends Controller
{
    //
    public function pageCalendar() {
        return view('MoneyHub.historyListCalendar');
    }

    public function pageResult() {
        
        return view('historyListResult');
    }
}
