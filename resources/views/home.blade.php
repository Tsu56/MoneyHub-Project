@extends('layouts.moneyhub')

@section('main')
<div class="card">
    <a href="{{ route('moneyhub.indexhome') }}"><img src="{{ asset('img/Banner-3.png') }}" class="card-img-top" alt="โฆษณามันนี่ฮับ"></a>
</div><br><br>

<div class="container mt-5" id="paragraph-1">
    <h1 class="py-6">บันทึกง่าย เข้าใจง่าย <br> วางแผนการเงินได้สบายกับ <br> <span><h1>MoneyHub</h1></span></h1>
    <ul>
        <li>ช่วยให้คุณดูรายรับ-รายจ่ายได้อย่างเข้าใจ</li>
        <li>จัดการการเงินได้ง่าย และสวยงาม</li>
        <li>ช่วยให้คุณวางแผนการเงิน อย่างเป็นระบบ</li>
        <li>รู้ทุกรายรับ-รายจ่าย วางแผนการเงินได้แม่นยำ</li>
    </ul>
    <button type="button" class="btn custom-btn-blue">บันทึกรายรับ-รายจ่าย</button>
</div><br><br>

<div class="container mt-3">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <img src="{{ asset('img/ads-5.png') }}" class="rounded-circle img-pointer" alt="โฆษณาวงกลม" width="304" height="236">
        </div>
        <div class="col-md-4 mx-auto">
            <img src="{{ asset('img/ads.png') }}" class="rounded-circle img-pointer" alt="โฆษณาวงกลม-2" width="304" height="236">
        </div>
        <div class="col-md-4 mx-auto">
            <img src="{{ asset('img/ads-4.png') }}" class="rounded-circle img-pointer" alt="โฆษณาวงกลม-3" width="304" height="236">
        </div>
    </div>
</div><br><br>

<div class="card" id="card-2">
    <a href="{{ route('moneyhub.indexhome') }}"><img src="{{ asset('img/Banner-2.png') }}" class="card-img-top" alt="โฆษณามันนี่ฮับ"></a>
</div><br><br>


@endsection