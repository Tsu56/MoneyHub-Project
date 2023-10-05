<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\Gender;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class adminController extends Controller
{
    public function index(){
        $amountOfUser = User::all()->count();
        $amountNormalUser = User::where('is_plus', 0)->count();
        $amountPremiumUser = User::where('is_plus', 1)->count();

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

        $gender = Gender::all();
        $career = Career::all();
        $users = User::all();

        return view('adminhome', compact('amountOfUser', 'amountNormalUser', 'amountPremiumUser', 'dataCareer', 'users'));
    }
}
