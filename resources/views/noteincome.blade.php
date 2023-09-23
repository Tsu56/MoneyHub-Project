@extends('layouts.moneyhub')

@section('main')
<div class="container p-5 my-5 border">
    <p class="h2 text-center"> บันทึกรายรับ-รายจ่าย</p>

    <div class="btn-group d-flex justify-content-center bg-pink">
        <a href="{{ route('moneyhub.noteincome', ['user_id' => auth()->user()->id])}}">
            <button type="button" class="btn ">รายรับ</button>
        </a>
        <a href="{{ route('moneyhub.noteincome', ['user_id' => auth()->user()->id])}}">
            <button type="button" class="btn ">รายจ่าย</button>
        </a>
    </div>

    <hr>

    <div class="container p-5 my-5 text-white custom-pink-container">
        <!-- รอฟอร์ม...  -->
        <div>
            <p class="h6 text-center">ประเภทค่าใช้จ่าย
                <select name="category" id="category">
                    <option value=""></option>
                </select>
            </p>
        </div>

    </div>
</div>
@endsection