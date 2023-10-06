@extends('layouts.moneyhub')

@section('main')
<p class="h2 text-center">บันทึกรายรับ-รายจ่าย</p>
<div class="btn-group d-flex justify-content-center bg-yellow">
    <a href="{{ route('moneyhub.noteincome', ['user_id' => auth()->user()->id])}}">
        <button type="button" class="btn">รายรับ</button>
    </a>
    <a href="{{ route('moneyhub.noteexpense', ['user_id' => auth()->user()->id])}}">
        <button type="button" class="btn">รายจ่าย</button>
    </a>
</div>


<div class="container p-5 my-6 text-white custom-pink-container">
    <form action="{{ route('moneyhub.inserttransaction') }}" method="post">
        @csrf
        <p class="h3 text-center">บันทึกรายจ่าย</p>
        <hr>
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <br>
        <input type="text" name="us_id" value={{auth()->user()->id}} hidden>
        <input type="text" name="trantype" value=2 hidden>

        <label for="typeincome" class="form-label">ประเภทค่าใช้จ่าย :</label>
        <div class="form-floating">
            <select class="form-select" name="category" id="category" onchange="selectChange()" required>
                @foreach ($categories as $category)
                <option>{{$category->category_name}}</option>
                @endforeach
                <option>อื่นๆ</option>
            </select>
            <label for="sel1" class="form-label text-dark">Select type (select one):</label>
        </div>
        <input type="text" class="form-control" placeholder="กรอกประเภทค่าใช้จ่ายอื่นๆ" name="otherCategory" id="otherCategory" hidden>


        <div class="mb-3 mt-3">
            <label for="money" class="form-label">จำนวนเงิน(บาท) :</label>
            <input type="number" step="0.01" class="form-control" id="money" placeholder="00.00" name="amount" required>
        </div>


        <label for="comment" class="form-label">คำอธิบาย :</label>
        <div class="mb-3 mt-3">
            <textarea class="form-control" rows="5" id="comment" name="description"></textarea>
        </div><br>


        <div class="container text-center">
            <button type="submit" class="btn btn-success mx-auto d-block" id="insert-btn" name="insert-btn">บันทึก</button>
        </div>

    </form>
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