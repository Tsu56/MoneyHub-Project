<?php

namespace App\Http\Controllers;

use App\Exports\SummarizeExport;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use CSV;

class transactionController extends Controller
{
    public function noteIncomeForm($user_id){
        $categories = Category::where("transaction_type_id", 1)->get();
        $userinfo = User::find($user_id);
        return view('noteincome', compact('userinfo', 'categories'));
    }

    public function noteExpenseForm($user_id){
        $categories = Category::where("transaction_type_id", 2)->get();
        $userinfo = User::find($user_id);
        return view('noteexpense', compact('userinfo', 'categories'));
    }

    public function insertTransaction(Request $request){
        if ($request->trantype == 1) {
            $balance = User::find($request->us_id);
            $balance->balance += $request->amount;
            $balance->save();
        } else {
            $balance = User::find($request->us_id);
            $balance->balance -= $request->amount;
            $balance->save();
        }

        $new_transaction = new Transaction;
        $new_transaction->us_id = $request->us_id;
        $new_transaction->transaction_type_id = $request->trantype;

        if ($request->otherCategory == null) {
            $categories = Category::where("transaction_type_id", $request->trantype)->get();
            foreach ($categories as $category){
                if($request->category == $category->category_name) {
                    $new_transaction->category_id = $category->id;
                    break;
                }
            }
        } else {
            $new_category = new Category;
            $new_category->category_name = $request->otherCategory;
            $new_category->transaction_type_id = $request->trantype;
            $new_category->save();
            $category = Category::where("category_name", $request->otherCategory)->first();
            $new_transaction->category_id = $category->id;
        }
        
        $new_transaction->transaction_description = $request->description;
        $new_transaction->transaction_amount = $request->amount;  
        $new_transaction->transaction_datetime = date("Y-m-d H:i:s", strtotime("now"));
        $new_transaction->save();
        return redirect( route('moneyhub.noteincome', ['user_id' => auth()->user()->id]));
    }

    public static function getAllTransaction(Request $request){
        $result = Transaction::join('transaction_types', 'transaction_types.id', '=', 'transactions.transaction_type_id')
                             ->join('categories', 'categories.id', '=', 'transactions.category_id')
                             ->where('transactions.us_id', auth()->user()->id)
                             ->whereBetween('transaction_datetime', [$request->Start, $request->End])
                             ->select('transaction_types.transaction_type_name', 'categories.category_name', 'transactions.transaction_amount', 'transactions.transaction_description', 'transactions.transaction_datetime')
                             ->get();
        
        // return response()->json(['start'=>$request->Start, 'end'=>$request->End]);

        return response()->json($result);
    }
}
