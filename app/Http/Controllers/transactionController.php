<?php

namespace App\Http\Controllers;

use App\Exports\SummarizeExport;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use CSV;

class transactionController extends Controller
{
    public function noteIncomeForm($user_id){
        $categories = Category::where("transaction_type_id", 1)->get();
        $userinfo = User::find($user_id);
        return view('noteincome', compact('userinfo', 'categories'));
    }
    /**       ใช้แสดงแบบฟอร์มบันทึกรายได้ของผู้ใช้ ที่ระบุโดยใช้ $user_id เป็นพารามิเตอร์:
        ดึงข้อมูลของผู้ใช้และรายการหมวดหมู่ที่เป็นรายได้จากฐานข้อมูล ฟังก์ชันจะส่งข้อมูลนี้ไปยังหน้า noteincome 
        โดยใช้ฟังก์ชัน view และทำการส่งข้อมูลผู้ใช้และรายการหมวดหมู่ไปกับการแสดงผลด้วย compact  **/

    public function noteExpenseForm($user_id){
        $categories = Category::where("transaction_type_id", 2)->get();
        $userinfo = User::find($user_id);
        return view('noteexpense', compact('userinfo', 'categories'));
    }
    /**      ใช้ในการแสดงแบบฟอร์มสำหรับบันทึกรายจ่ายของผู้ใช้:
        ดึงข้อมูลของผู้ใช้และรายการหมวดหมู่ที่เป็นรายจ่ายจากฐานข้อมูล
        จากนั้นฟังก์ชันจะส่งข้อมูลนี้ไปยังหน้า noteexpense โดยใช้ compact **/

    public function insertTransaction(Request $request){
        /*      ตรวจสอบประเภทของธุรกรรม โดยใช้ $request->trantype ซึ่งเป็นค่าที่ผู้ใช้เลือกในแบบฟอร์ม (1, 2. โดยที่ 1 แทนรายได้และ 2 แทนรายจ่าย)   */
        if ($request->trantype == 1) {
            $balance = User::find($request->us_id);
            $balance->balance += $request->amount;
            $balance->save();
        } else {
            $balance = User::find($request->us_id);
            $balance->balance -= $request->amount;
            $balance->save();
        } /*     อัปเดตเงินคงเหลือของผู้ใช้ โดยเพิ่มหรือลดจำนวนเงินขึ้นออกไป กรณีรายได้ (1) เราเพิ่มจำนวนเงินในฟิลด์ balance ของผู้ใช้ 
            และในกรณีรายจ่าย (2) เราลดจำนวนเงินในฟิลด์ balance ของผู้ใช้ และทำการบันทึกการเปลี่ยนแปลงนี้ในฐานข้อมูล  */

        $new_transaction = new Transaction;
        $new_transaction->us_id = $request->us_id;
        $new_transaction->transaction_type_id = $request->trantype;

        if ($request->otherCategory == null) { /*  ตรวจสอบว่าผู้ใช้เลือกหมวดหมู่ที่มีอยู่หรือไม่  */
            $categories = Category::where("transaction_type_id", $request->trantype)->get();
            foreach ($categories as $category){
                if($request->category == $category->category_name) {
                    $new_transaction->category_id = $category->id;
                    break;
                }
            }
        } else {  /*   สร้างหมวดหมู่ใหม่หากผู้ใช้เลือก "อื่น ๆ"  */
            $new_category = new Category;
            $new_category->category_name = $request->otherCategory;
            $new_category->transaction_type_id = $request->trantype;
            $new_category->save();
            /*   หาหมวดหมู่ที่เพิ่งสร้าง   */ 
            $category = Category::where("category_name", $request->otherCategory)->first();
            $new_transaction->category_id = $category->id;
        }
        
        $new_transaction->transaction_description = $request->description;
        $new_transaction->transaction_amount = $request->amount;  
        $new_transaction->transaction_datetime = date("Y-m-d H:i:s", strtotime("now"));
        $new_transaction->save();
        return redirect( route('moneyhub.noteincome', ['user_id' => auth()->user()->id]));
        /*  ใช้คำสั่ง redirect เพื่อเปลี่ยนเส้นทางการเรียกใช้หน้าเว็บไปยังหน้า noteincome หรือ noteexpense ขึ้นอยู่กับประเภทของธุรกรรมที่ผู้ใช้เลือก  */
    }

    /***   ใช้ในการรับข้อมูลการเงินทั้งหมดของผู้ใช้และส่งข้อมูลกลับในรูปแบบ JSON โดยใช้คำขอ HTTP ที่ถูกส่งมาผ่านพารามิเตอร์ $request   ***/
    public static function getAllTransaction(Request $request){
        /**  ใช้คำสั่ง SQL ในการรวมข้อมูลจากตาราง Transaction ตาราง transaction_types และ categories โดยใช้ฟังก์ชัน join และกำหนดเงื่อนไขในการเชื่อมโยงข้อมูลระหว่างตาราง  **/
        $result = Transaction::join('transaction_types', 'transaction_types.id', '=', 'transactions.transaction_type_id')
                             ->join('categories', 'categories.id', '=', 'transactions.category_id')
                             /**  ใช้เงื่อนไข where เพื่อเลือกเฉพาะการเงินที่เกี่ยวข้องกับผู้ใช้ปัจจุบัน โดยใช้ auth()->user()->id เป็นไอดีของผู้ใช้ที่ลงชื่อเข้าใช้  **/
                             ->where('transactions.us_id', auth()->user()->id)
                             /**  ใช้เงื่อนไข whereBetween เพื่อเลือกการเงินที่อยู่ในช่วงเวลาที่ผู้ใช้ต้องการ โดยใช้ $request->Start และ $request->End ที่เป็นข้อมูลที่ผู้ใช้ส่งมาในคำขอ  **/
                             ->whereBetween('transaction_datetime', [$request->Start, $request->End])
                             /**  ใช้ select เพื่อเลือกฟิลด์ที่เราต้องการให้แสดงในผลลัพธ์ ในกรณีนี้เราเลือกฟิลด์:  **/
                             ->select('transaction_types.transaction_type_name', 'categories.category_name', 'transactions.transaction_amount', 'transactions.transaction_description', 'transactions.transaction_datetime')
                             /**  ใช้ get เพื่อดึงข้อมูลทั้งหมดที่เลือกมา และเก็บไว้ในตัวแปร $result  **/
                             ->get();
        
        //  return response()->json(['start'=>$request->Start, 'end'=>$request->End]);
        //  ส่งข้อมูลที่ดึงมาในรูปแบบ JSON
        return response()->json($result);
    }
}
