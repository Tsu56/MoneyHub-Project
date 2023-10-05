<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;
use DateTimeInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class historyListController extends Controller
{
    //

    private function conv_trans_key_date($trans) {
        $trans_key_date = [];
        for($j=count($trans)-1; $j>=0; $j--) {
            if (!array_key_exists($trans[$j]['date'], $trans_key_date)) {
                $trans_key_date[$trans[$j]['date']] = [
                    'trans' => [], 
                    'analy' => [
                        'balance' => 0,
                        'income' => 0,
                        'expense' => 0
                ]];
                // var_dump('เพิ่ม column');
            }
            // $trans_key_date[$trans[$i]['date']] = $trans[$i];
            array_push($trans_key_date[$trans[$j]['date']]['trans'], $trans[$j]);
        }
        return $trans_key_date;
    }
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
        $user_id = auth()->user()->id;
        $categorys = Category::all();
        $trans = Transaction:: with('transaction_type')->with('category')->selectRaw('*, date(transactions.transaction_datetime) as date')->where('us_id', $user_id);
        if($request->start_date && $request->end_date) {
            $start = $request->start_date;
            $end = $request->end_date;
            $start = date_format(date_create($start), 'Y-m-d H:i:s');
            $end = date_format(date_create($end), 'Y-m-d H:i:s');
            $trans = $trans->whereBetween('transaction_datetime', [$start, $end]);
        }
        $trans = $trans->get();
        $trans = $this->conv_trans_key_date($trans);
        krsort($trans);
        // return $trans;
        // return array_keys($trans)[count($trans)-1];
        return view('MoneyHub.historyListResult', compact('trans', 'categorys'));
    }

    public function getMonthTransaction(Request $request) {
        $start = ($request->start);
        $last = ($request->last);
        $analize_trans = array(
            'income' => 0,
            'expense' => 0,
            'balance' => 0
        );
        $trans = Transaction::where('us_id', auth()->user()->id)->get();
        for($i=0; $i<count($trans); $i++) {
            $trans[$i]['transaction_datetime'] = date_format(date_create($trans[$i]['transaction_datetime']), 'Y-m-d') ;
            if( strtotime($trans[$i]['transaction_datetime']) >= strtotime($start) && strtotime($trans[$i]['transaction_datetime']) <= strtotime($last)) {
                if($trans[$i]['transaction_type_id'] == 1) $analize_trans['income'] += $trans[$i]['transaction_amount'];
                if($trans[$i]['transaction_type_id'] == 2) $analize_trans['expense'] += $trans[$i]['transaction_amount'];
            }
        }
        $analize_trans['balance'] = $analize_trans['income'] - $analize_trans['expense'];
        $data = [
            'analy' => $analize_trans
        ];
        return response()->json($data);
    }

    public function deleteTran(Request $request) {
        if($request->id) {
            $us_id = auth()->user()->id;
            $tran = Transaction::where('id', $request->id)->where('us_id', $us_id)->get();
            if($tran) {
                Transaction::destroy($request->id);
            }else {
                return 'เกิดข้อผิดพลาด';
            }
        }
        return redirect()->back();
    }

    public function updateTran(Request $request) {
        $us_id = auth()->user()->id;
        $tran = Transaction::where('id', $request['tran-id'])->where('us_id', $us_id);
        $tran->update(['transaction_description' => $request['description']]);
        $tran->update(['category_id' => $request['category']]);
        $tran->update(['transaction_amount' => $request['amount']]);
        // return $tran;
        return redirect()->back();
    }

}

