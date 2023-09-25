@extends('layouts.moneyhub')

@section('main')
    <script>
        function selectChange(){
            if(document.getElementById('category').value == 'อื่นๆ'){
                document.getElementById('otherCategory').hidden = false;
                document.getElementById('btn-add').hidden = false;
            } else{
                document.getElementById('otherCategory').hidden = true;
                document.getElementById('btn-add').hidden = true;
            }
        }
    </script>
    <p class="h2 text-center">รายรับ-รายจ่าย</p>
    <div>
        <ul>
            <li><a class="h6 text-center" href="{{ route('moneyhub.noteincome', ['user_id' => auth()->user()->id])}}">รายรับ</a></li>
            <li><a class="h6 text-center" href="{{ route('moneyhub.noteexpense', ['user_id' => auth()->user()->id])}}">รายจ่าย</a></li>
        </ul>
    </div>
    <div>
        <form action="{{ route('moneyhub.inserttransaction') }}" method="post">
            @csrf
            <input type="text" name="us_id" value={{auth()->user()->id}} hidden>
            <input type="text" name="trantype" value=2 hidden>
            <p class="h6 text-center">ประเภทค่าใช้จ่าย
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
@endsection