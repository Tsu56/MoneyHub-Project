@extends('layouts.moneyhub')

@section('add-link')
<link rel="stylesheet"  href="{{ asset('/css/QR.css') }}">
@endsection

@section('main')
<div class="container">
    
    <form action="{{ route('moneyhub.Qrcodelink') }}">
        
        <div class="row">
            @if(auth()->user()->payment_status)
                <h1 class="h1 text-center">จ่ายเงินเพื่อต่อเวลาบาดเจ็บ😭</h1>
            @else 
                <h1 class="h1 text-center">จ่ายเงินเพื่อใช้งาน Premium</h1>
            @endif
            <H2>สแกน QR CODE</H2>
            <div class="col">
             
                <div id="image-container">
                    <img src="{{ asset('/img/QR2.png') }}" class="qr" alt="คำอธิบายรูปภาพ"> 
                    
                </div>
                
                <H2>49บาท</H2>

            <div class="col">
       

                <div class="flex">
                    
                    
                </div>

            </div>
            <input type="submit" value="เสร็จสิ้น" class="submit-btn">
        </div>
        
        

    </form>
    
</div>
@endsection 