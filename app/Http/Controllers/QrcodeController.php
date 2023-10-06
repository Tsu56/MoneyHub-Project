<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QrcodeController extends Controller
{
    public function QR(Request $request)
    {
        if($request->rp) {
            self::checkExpire(1);
        }
        return view("QR");
    }

    public static function checkExpire($rp=0) {
        $payment_date = auth()->user()->payment_datetime;
        $payment_expired = auth()->user()->payment_expired;
        $user_id = auth()->user()->id;
        $user = User::where('id', $user_id);
        $refresh = 0;
        if( (date_create('now') > date_create($payment_expired)) && $payment_expired) {
            $user->update([
                'is_plus' => 0,
                'payment_status' => 0,
                'payment_expired' => null,
                'payment_datetime' => null
            ]);
            $refresh = 1;
        }
        if($rp) {
            $user->update([
                'is_plus' => 0,
                'payment_status' => 0,
                'payment_expired' => null,
                'payment_datetime' => null
            ]);
            $refresh = 1;
        }
        return $refresh;
    }

    public function link(Request $request)
    {   

        $user = Auth::user();
        if ($user) {

            // เพิ่มใหม่
            $cur_date = date_create('now');
            $expired_date = date_create('now');
            $expired_date = date_add($expired_date, date_interval_create_from_date_string('20 minute'));
            // return [$cur_date, $expired_date];


            DB::table('users')
                ->where('id', $user->id)
                ->update(
                    [
                        'is_plus' => 1,
                        'payment_status' => 1,
                        'payment_datetime' => $cur_date,

                        // เพิ่มใหม่
                        'payment_expired' => $expired_date
                        //
                    ]
                );
        }
        return redirect()->route('moneyhub.indexhome');
    }
}
