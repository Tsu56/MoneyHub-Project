<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class summarizeController extends Controller
{
    public function index(){
        return view("summarize");
    }
}
