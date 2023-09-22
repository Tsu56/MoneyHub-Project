<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class moneyhubController extends Controller
{
    public function showHome(){
        return view("home");
    }

    public function showSummarize(){
        return view("summarize");
    }
}
