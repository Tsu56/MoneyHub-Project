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
    <h3>รายรับ-รายจ่าย</h3>
    <div>
        <ul>
            <li><a href="{{ route('moneyhub.noteincome', ['user_id' => auth()->user()->id])}}">รายรับ</a></li>
            <li><a href="{{ route('moneyhub.noteexpense', ['user_id' => auth()->user()->id])}}">รายจ่าย</a></li>
        </ul>
    </div>
    <div>
        <form action="{{ route('moneyhub.inserttransaction') }}" method="post">
            @csrf
            <input type="text" name="us_id" value={{auth()->user()->id}} hidden>
            <input type="text" name="trantype" value=2 hidden>
            <p>ประเภทค่าใช้จ่าย
                <select name="category" id="category" onchange="selectChange()" required>
                    @foreach ($categories as $category)
                    <option>{{$category->category_name}}</option>
                    @endforeach
                    <option>อื่นๆ</option>
                </select><br>
                <input type="text" name="otherCategory" id="otherCategory" hidden>
            </p>
            <p>จำนวนเงิน
                <input type="text" name="amount" required>
            </p>
            <p>คำอธิบาย
                <input type="text" name="description">
            </p>
            <button type="submit" id="insert-btn" name="insert-btn">บันทึก</button>
        </form>
    </div>
@endsection