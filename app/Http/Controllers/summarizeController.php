<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\SummarizeExport;
use CSV;

class summarizeController extends Controller
{
    public function index($user_id){
        $StartdateForSetForm = now();
        $EnddateForSetForm = now();
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

        $incomeTextforChart = "";
        $expenseTextforChart = "";

        foreach ($listIncome as $value) {
            $incomeTextforChart.="['".$value->category_name."', ".$value->Total_amount."],"; 
        }
        $completeIncomeDataForchart = $incomeTextforChart;

        foreach ($listExpense as $value) {
            $expenseTextforChart.="['".$value->category_name."', ".$value->Total_amount."],"; 
        }    
        $completeExpenseDataForchart = $expenseTextforChart; 

        return view("summarize", compact('Total_income', 'Total_expense', 'completeIncomeDataForchart', 'completeExpenseDataForchart', 'StartdateForSetForm', 'EnddateForSetForm'));
    }

    public function getSummarize(Request $request){
        $StartdateForSetForm = $request->startdate;
        $EnddateForSetForm = $request->enddate;
        $Total_income = Transaction::where('us_id', $request->us_id)
                                   ->where('transaction_type_id', 1)
                                   ->whereBetween('transaction_datetime', [$request->startdate, $request->enddate])
                                   ->sum('transaction_amount');
        $Total_expense = Transaction::where('us_id', $request->us_id)
                                   ->where('transaction_type_id', 2)
                                   ->whereBetween('transaction_datetime', [$request->startdate, $request->enddate])
                                   ->sum('transaction_amount');
        $listIncome = Transaction::join('categories', 'categories.id', '=', 'transactions.category_id')
                                   ->where('transactions.us_id', $request->us_id)
                                   ->where('transactions.transaction_type_id', 1)
                                   ->whereBetween('transaction_datetime', [$request->startdate, $request->enddate])
                                   ->select('categories.category_name', DB::raw('SUM(transaction_amount) as Total_amount'))
                                   ->groupBy('transactions.category_id', 'categories.category_name')
                                   ->get();
        $listExpense = Transaction::join('categories', 'categories.id', '=', 'transactions.category_id')
                                   ->where('transactions.us_id', $request->us_id)
                                   ->where('transactions.transaction_type_id', 2)
                                   ->whereBetween('transaction_datetime', [$request->startdate, $request->enddate])
                                   ->select('categories.category_name', DB::raw('SUM(transaction_amount) as Total_amount'))
                                   ->groupBy('transactions.category_id', 'categories.category_name')
                                   ->get();

        $incomeTextforChart = "";
        $expenseTextforChart = "";
                           
        foreach ($listIncome as $value) {
            $incomeTextforChart.="['".$value->category_name."', ".$value->Total_amount."],"; 
        }
        $completeIncomeDataForchart = $incomeTextforChart;
                           
        foreach ($listExpense as $value) {
            $expenseTextforChart.="['".$value->category_name."', ".$value->Total_amount."],"; 
        }    
        $completeExpenseDataForchart = $expenseTextforChart;

        return view("summarize", compact('Total_income', 'Total_expense', 'completeIncomeDataForchart', 'completeExpenseDataForchart', 'StartdateForSetForm', 'EnddateForSetForm'));
    }

    public function exportCSV(){
        return CSV::download(new SummarizeExport, 'transaction-record.csv');
    }
}
