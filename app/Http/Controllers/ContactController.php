<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enquiry;

class ContactController extends Controller
{
    public function contact()
    {

        return view('contact/contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'msg' => 'required|string',
        ]);

        return redirect()->route('moneyhub.contact')->with('success', 'ส่งข้อความสำเร็จ!');;
    }
}
