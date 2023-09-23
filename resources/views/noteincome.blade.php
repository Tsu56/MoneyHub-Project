@extends('layouts.moneyhub')

@section('main')
    <br><br>
    <p class="h2 text-center">รายรับ-รายจ่าย</p>
    <div>
        <ul>
            <li><a class="h6 text-center" href="{{ route('moneyhub.noteincome', ['user_id' => auth()->user()->id])}}">รายรับ</a></li>
            <li><a class="h6 text-center" href="{{ route('moneyhub.noteincome', ['user_id' => auth()->user()->id])}}">รายจ่าย</a></li>
        </ul>
    </div>
    <div>
        <p class="h6 text-center">ประเภทค่าใช้จ่าย
            <select name="category" id="category">
                <option value=""></option>
            </select>
        </p>
    </div>
@endsection