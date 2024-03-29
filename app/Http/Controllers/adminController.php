<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\Enquiry;
use App\Models\Gender;
use App\Models\Payment;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class adminController extends Controller
{
    public function index(){
        $amountOfUser = User::all()->count();
        $amountNormalUser = User::where('is_plus', 0)->count();
        $amountPremiumUser = User::where('is_plus', 1)->where('is_admin', 0)->count();
        $amountAdmin = User::where('is_admin', 1)->count();

        $listCareer = User::join('careers', 'careers.id', '=', 'users.career_id')
                          ->select('careers.career_name', DB::raw('COUNT(career_id) as amount'))
                          ->groupBy('users.career_id', 'careers.career_name')
                          ->get();

        $dataCareer = [];
        foreach ($listCareer as $value) {
            $dataCareer[] = array(
                'label' => $value->career_name,
                'y' => $value->amount
            );
        }

        $users = User::all();
        $payments = Payment::all();
        $enquiries = Enquiry::all();

        return view('adminhome', compact('amountOfUser', 'amountNormalUser', 'amountPremiumUser', 'amountAdmin' , 'dataCareer', 'users', 'enquiries', 'payments'));
    }

    public function delete($user_id){
        User::destroy($user_id);
        Transaction::where('us_id', $user_id)->delete();
        Enquiry::where('us_id', $user_id)->delete();
        return redirect(route('moneyhub.admin'));
    }

    public function grantAdmin($user_id) {
        $user = User::find($user_id);
        $user->is_admin = !$user->is_admin;
        $user->save();
        return redirect(route('moneyhub.admin'));
    }

    public function deleteMsg($id) {
        Enquiry::destroy($id);
        return redirect(route('moneyhub.admin'));
    }
}
