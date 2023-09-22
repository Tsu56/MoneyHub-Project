<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class incomeController extends Controller
{
    public function noteIncomeForm($user_id){
        $userinfo = User::find($user_id);
        return view('noteincome', compact('userinfo'));
    }
}
