@extends('layouts.moneyhub')

@section('main')
<p class="h2 text-center">บันทึกรายรับ-รายจ่าย</p>
<!--  select_Group รายรับ-รายจ่าย -->
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
        <p class="h3 text-center">บันทึกรายรับ</p>
        <hr>
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <br>
        <!--  ระบุค่าที่จะถูกแสดงในช่องข้อมูล ค่านี้จะเป็นไอดีของผู้ใช้ที่ลงชื่อเข้าใช้ (ใช้ auth()->user()->id เพื่อดึงไอดีผู้ใช้ปัจจุบัน)
              ช่องข้อมูลนี้ถูกซ่อนแสดงอยู่ ผู้ใช้จะไม่เห็นช่องข้อมูลนี้บนหน้าเว็บ แต่ค่าข้อมูลจะถูกส่งไปยังเซิร์ฟเวอร์เมื่อผู้ใช้ส่งแบบฟอร์ม -->
        <input type="text" name="us_id" value={{auth()->user()->id}} hidden>
        <input type="text" name="trantype" value=1 hidden>
        <!-- ระบุชื่อฟิลด์ที่จะส่งข้อมูลไปยังเซิร์ฟเวอร์เมื่อผู้ใช้ส่งแบบฟอร์ม value=1 ค่า 1 (ใช้เพื่อแสดงว่าเป็นรายได้) -->

        <label for="typeincome" class="form-label">ประเภทรายรับ :</label>
        <div class="form-floating">  <!--  เรียกฟังก์ชัน selectChange() เมื่อมีการเลือกประเภทรายรับ  -->
            <select class="form-select" name="category" id="category" onchange="selectChange()" required>
                @foreach ($categories as $category) <!--  แสดงตัวเลือกสำหรับประเภทรายรับที่มีอยู่ในตัวแปร $categories  -->
                <option>{{$category->category_name}}</option> <!-- ใช้ในการแสดงชื่อประเภทรายรับจากตัวแปร $category  -->
                @endforeach
                <option>อื่นๆ</option>
            </select>
            <label for="sel1" class="form-label text-dark">Select type (select one):</label>
        </div>
        <input type="text" class="form-control" placeholder="กรอกประเภทอื่นๆ" name="otherCategory" id="otherCategory" hidden>


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
        if // เมื่อผู้ใช้เลือก "อื่นๆ" ค่าในอิลิเมนต์ <select> 'อื่นๆ' คำสั่งในบล็อก if จะทำงาน
        (document.getElementById('category').value == 'อื่นๆ') {
            document.getElementById('otherCategory').hidden = false;
            document.getElementById('btn-add').hidden = false;
        } else {
            // เมื่อผู้ใช้ไม่ได้เลือก "อื่นๆ" อิลิเมนต์นี้จะถูกซ่อน.
            document.getElementById('otherCategory').hidden = true;
            document.getElementById('btn-add').hidden = true;
        }
    }
</script>
@endsection