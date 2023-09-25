<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

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
        $categories = Category::where("transaction_type_id", $request->trantype)->get();
        $new_transaction = new Transaction;
        $new_transaction->us_id = $request->us_id;
        $new_transaction->transaction_type_id = $request->trantype;

        if ($request->otherCategory == null) {
        } else {
            $new_category = new Category;
            $new_category->category_name = $request->otherCategory;
            $new_category->transaction_type_id = $request->trantype;
            $new_category->save();
        }
        
        foreach ($categories as $category){
            if($request->category == $category->category_name) {
                $new_transaction->category_id = $category->id;
                break;
            }
        }

        $new_transaction->transaction_description = $request->description;
        $new_transaction->transaction_amount = $request->amount;
        $new_transaction->transaction_datetime = date("Y-m-d H:i:s", strtotime("now"));
        $new_transaction->save();
        return redirect( route('moneyhub.noteincome', ['user_id' => auth()->user()->id]));
    }
}