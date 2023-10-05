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
        $new_request = new Enquiry;
        $new_request->us_id = auth()->user()->id;
        $new_request->description = $request->msg;
        $new_request->save();
        return redirect()->route('moneyhub.contact')->with('success', 'ส่งข้อความสำเร็จ!');;
    }
}
