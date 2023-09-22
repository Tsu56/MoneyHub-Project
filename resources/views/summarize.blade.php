@extends('layouts.moneyhub')

@section('main')
    <span>เลือกช่วง</span>
    <form action="" method="post">
        <label for="start">เริ่ม</label>
        <input type="date" name="start-date" id="start-date">
        <label for="end">สิ้นสุด</label>
        <input type="date" name="end-date" id="end-date">
        <button type="submit">โอเค!</button>
    </form>
@endsection