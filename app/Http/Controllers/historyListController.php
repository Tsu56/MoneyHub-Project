<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class historyListController extends Controller
{
    //
    public function pageCalendar() {
        $index = 0;
        $transac_cal_table = array();
        $user_transactions = Transaction::where('us_id', Auth::user()->id)->get();
        foreach ($user_transactions as $transac) {
            $date = Carbon::createFromFormat('Y-m-d H:i:s', $transac->transaction_datetime)->format('Y-m-d');
            if(!array_key_exists($date, $transac_cal_table)) {
                $transac_cal_table[$date] = array(
                    'income' => 0,
                    'expense' => 0,
                    'balance' => 0
                );
            }
            if($transac->transaction_type_id==1) {
                $transac_cal_table[$date]['income'] += $transac->transaction_amount;
            }else if ($transac->transaction_type_id==2) {
                $transac_cal_table[$date]['expense'] += $transac->transaction_amount;
            }
            $index++;
        }
        foreach($transac_cal_table as $key => $val) {
            $transac_cal_table[$key]['balance'] = $transac_cal_table[$key]['income'] - $transac_cal_table[$key]['expense'];
        }
        // return $transac_cal_table;
        return view('MoneyHub.historyListCalendar', compact('transac_cal_table'));
    }

    public function pageResult(Request $request) {
        return $request;
        // return view('MoneyHub.historyListResult');
    }
}
