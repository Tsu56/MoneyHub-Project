<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class summarizeController extends Controller
{
    public function index($user_id){
        $StartdateForSetForm =  date_format(date_create(now()), 'Y-m-d');
        $EnddateForSetForm = date_format(date_create(now()), 'Y-m-d');
        $Total_income = Transaction::where('us_id', $user_id)
                                   ->where('transaction_type_id', 1)
                                   ->whereMonth('transaction_datetime', Carbon::now()->month)
                                   ->sum('transaction_amount');
        $Total_expense = Transaction::where('us_id', $user_id)
                                   ->where('transaction_type_id', 2)
                                   ->whereMonth('transaction_datetime', Carbon::now()->month)
                                   ->sum('transaction_amount');
        $listIncome = Transaction::join('categories', 'categories.id', '=', 'transactions.category_id')
                                   ->where('transactions.us_id', $user_id)
                                   ->where('transactions.transaction_type_id', 1)
                                   ->whereMonth('transaction_datetime', Carbon::now()->month)
                                   ->select('categories.category_name', DB::raw('SUM(transaction_amount) as Total_amount'))
                                   ->groupBy('transactions.category_id', 'categories.category_name')
                                   ->get();
        $listExpense = Transaction::join('categories', 'categories.id', '=', 'transactions.category_id')
                                   ->where('transactions.us_id', $user_id)
                                   ->where('transactions.transaction_type_id', 2)
                                   ->whereMonth('transaction_datetime', Carbon::now()->month)
                                   ->select('categories.category_name', DB::raw('SUM(transaction_amount) as Total_amount'))
                                   ->groupBy('transactions.category_id', 'categories.category_name')
                                   ->get();

        $dataIncome = [];
        foreach ($listIncome as $value) {
            $dataIncome[] = array(
                'label' => $value->category_name,
                'y' => $value->Total_amount
            );
        }

        $dataExpense = [];
        foreach ($listExpense as $value) {
            $dataExpense[] = array(
                'label' => $value->category_name,
                'y' => $value->Total_amount
            );
        }
        // $dataIncome = response()->json($dataIncome);
        return view("summarize", compact('Total_income', 'Total_expense', 'dataIncome', 'dataExpense', 'StartdateForSetForm', 'EnddateForSetForm'));
    }

    public function getSummarize(Request $request){
        $StartdateForSetForm = date_format(date_create($request->startdate), 'Y-m-d 00:00:00') ;
        $EnddateForSetForm = date_format(date_create($request->enddate), 'Y-m-d 23:59:29') ;
        $Total_income = Transaction::where('us_id', $request->us_id)
                                   ->where('transaction_type_id', 1)
                                   ->whereBetween('transaction_datetime', [$StartdateForSetForm, $EnddateForSetForm])
                                   ->sum('transaction_amount');
        $Total_expense = Transaction::where('us_id', $request->us_id)
                                   ->where('transaction_type_id', 2)
                                   ->whereBetween('transaction_datetime', [$StartdateForSetForm, $EnddateForSetForm])
                                   ->sum('transaction_amount');
        $listIncome = Transaction::join('categories', 'categories.id', '=', 'transactions.category_id')
                                   ->where('transactions.us_id', $request->us_id)
                                   ->where('transactions.transaction_type_id', 1)
                                   ->whereBetween('transaction_datetime', [$StartdateForSetForm, $EnddateForSetForm])
                                   ->select('categories.category_name', DB::raw('SUM(transaction_amount) as Total_amount'))
                                   ->groupBy('transactions.category_id', 'categories.category_name')
                                   ->get();
        $listExpense = Transaction::join('categories', 'categories.id', '=', 'transactions.category_id')
                                   ->where('transactions.us_id', $request->us_id)
                                   ->where('transactions.transaction_type_id', 2)
                                   ->whereBetween('transaction_datetime', [$StartdateForSetForm, $EnddateForSetForm])
                                   ->select('categories.category_name', DB::raw('SUM(transaction_amount) as Total_amount'))
                                   ->groupBy('transactions.category_id', 'categories.category_name')
                                   ->get();

        $dataIncome = [];
        foreach ($listIncome as $value) {
            $dataIncome[] = array(
                'label' => $value->category_name,
                'y' => $value->Total_amount
            );
        }
         
        $dataExpense = [];
        foreach ($listExpense as $value) {
            $dataExpense[] = array(
                'label' => $value->category_name,
                'y' => $value->Total_amount
            );
        }
        $StartdateForSetForm = date_format(date_create($request->startdate), 'Y-m-d') ;
        $EnddateForSetForm = date_format(date_create($request->enddate), 'Y-m-d') ;
        // return [$StartdateForSetForm, $EnddateForSetForm];
        return view("summarize", compact('Total_income', 'Total_expense', 'dataIncome', 'dataExpense', 'StartdateForSetForm', 'EnddateForSetForm'));
    }
}
