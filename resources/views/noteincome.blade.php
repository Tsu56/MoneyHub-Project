@extends('layouts.moneyhub')

@section('main')
    <h4>รายรับ-รายจ่าย</h4>
    <div>
        <ul>
            <li><a href="{{ route('moneyhub.noteincome', ['user_id' => auth()->user()->id])}}">รายรับ</a></li>
            <li><a href="{{ route('moneyhub.noteincome', ['user_id' => auth()->user()->id])}}">รายจ่าย</a></li>
        </ul>
    </div>
    <div>
        <p>ประเภทค่าใช้จ่าย
            <select name="category" id="category">
                <option value=""></option>
            </select>
        </p>
    </div>
@endsection