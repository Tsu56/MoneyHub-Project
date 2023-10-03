<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class QrcodeController extends Controller
{
    public function QR(){
        return view("QR");
    }

    public function link(Request $request) {
        
        
        $user = Auth::user(); 

        if ($user) {
        \DB::table('users')
        ->where('id', $user->id)
        ->update(['is_plus' => 1]);
}

        return redirect()->route('moneyhub.indexhome');
    }
}
