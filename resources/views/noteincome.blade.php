@extends('layouts.moneyhub')

@section('main')
<p class="h2 text-center">รายรับ-รายจ่าย</p>
<!--  select_Group รายรับ-รายจ่าย -->
<div class="btn-group d-flex justify-content-center bg-yellow">
    <a href="{{ route('moneyhub.noteincome', ['user_id' => auth()->user()->id])}}">
        <button type="button" class="btn">รายรับ</button>
    </a>
    <a href="{{ route('moneyhub.noteexpense', ['user_id' => auth()->user()->id])}}">
        <button type="button" class="btn">รายจ่าย</button>
    </a>
</div>



<div>
    <form action="{{ route('moneyhub.inserttransaction') }}" method="post">
        @csrf
        <input type="text" name="us_id" value={{auth()->user()->id}} hidden>
        <input type="text" name="trantype" value=1 hidden>
        <p class="h6 text-center">ประเภทรายรับ
            <select name="category" id="category" onchange="selectChange()" required>
                @foreach ($categories as $category)
                <option>{{$category->category_name}}</option>
                @endforeach
                <option>อื่นๆ</option>
            </select><br>
            <input type="text" name="otherCategory" id="otherCategory" hidden>
        </p>
        <p class="h6 text-center">จำนวนเงิน
            <input type="text" name="amount" required>
        </p>
        <p class="h6 text-center">คำอธิบาย
            <input type="text" name="description">
        </p>
        <button type="submit" id="insert-btn" name="insert-btn">บันทึก</button>
    </form>
</div>
</div>

<script>
    function selectChange() {
        if (document.getElementById('category').value == 'อื่นๆ') {
            document.getElementById('otherCategory').hidden = false;
            document.getElementById('btn-add').hidden = false;
        } else {
            document.getElementById('otherCategory').hidden = true;
            document.getElementById('btn-add').hidden = true;
        }
    }
</script>
@endsection