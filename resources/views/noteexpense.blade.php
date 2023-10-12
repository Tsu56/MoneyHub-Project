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


<div class="container p-5 my-6 text-white custom-pink-container rounded-5 mt-4 shadow ">
    <form action="{{ route('moneyhub.inserttransaction') }}" method="post">
        @csrf
        <p class="h3 text-center">บันทึกรายจ่าย 📈</p>
        <hr><br>
        <input type="text" name="us_id" value={{auth()->user()->id}} hidden>
        <input type="text" name="trantype" value=2 hidden>

        <label for="typeincome" class="form-label">ประเภทค่าใช้จ่าย :</label>
        <div class="row">
            <div class="col form-floating">
                <select class="form-select" name="category" id="category" onchange="selectChange()" required>
                    @foreach ($categories as $category)
                    <option {{ $category->us_id ? "us_id={$category->us_id}" : '' }} value="{{ $category->id }}">
                        @if ($category->us_id)
                            👤
                        @endif
                        {{$category->category_name}}
                    </option> <!-- ใช้ในการแสดงชื่อประเภทรายรับจากตัวแปร $category  -->
                    @endforeach
                    <option>อื่นๆ</option>
                </select>
                <label for="sel1" class="form-label text-dark">Select type (select one):</label>
            </div>
            <div class="col-2 d-none" id="show-edit-del">
                <button class="btn btn-warning mx-1">แก้ไข</button>
                <button class="btn btn-danger mx-1">ลบ</button>
            </div>
        </div>
        <input type="text" class="form-control" placeholder="กรอกประเภทค่าใช้จ่ายอื่นๆ" name="otherCategory" id="otherCategory" hidden>

        <div class="mb-3 mt-3">
            <label for="money" class="form-label">จำนวนเงิน(บาท) :</label>
            <input type="number" step="0.01" class="form-control" id="money" placeholder="00.00" name="amount" required>
        </div>
        
        <div class="mb-3 mt-3">
            <label for="money" class="form-label">วันที่ :</label>
            <label for="custom-tran-datetime" title="คำเตือน!" data-bs-toggle="popover" data-bs-placement="right"
            data-bs-content="หากกำหนดเอง จะไม่สามารถกำหนด วินาทีได้!" data-bs-trigger="hover focus">กำหนดเอง :</label>
            <input class="form-check-input" onclick="checkCustomDate()" type="checkbox" name="custom-tran-datetime" id="custom-tran-datetime"
                title="คำเตือน!" data-bs-toggle="popover" data-bs-placement="right"
                data-bs-content="หากกำหนดเอง จะไม่สามารถกำหนด วินาทีได้!" data-bs-trigger="hover focus">
            <input title="คำเตือน! หากกำหนดเอง จะไม่สามารถกำหนด วินาที ได้!" type="datetime-local"
                value="{{ date_format(date_create('now'), 'Y-m-d H:i') }}" onchange="checkDate()" class="form-control"
                id="tran-datetime" placeholder="00.00" name="tran-datetime" required>
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
    $(document).ready((e) => {
        const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
        const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(
            popoverTriggerEl))
    });

    $(document).ready(() => {
        if ($('#custom-tran-datetime:checked').val()) {
            $('#tran-datetime').prop('disabled', false);
        } else {
            $('#tran-datetime').prop('disabled', true);
        }
    });

    function checkCustomDate() {
        if ($('#custom-tran-datetime:checked').val()) {
            $('#tran-datetime').prop('disabled', false);
        } else {
            $('#tran-datetime').prop('disabled', true);
        }
    }

    function checkDate() {
        if (new Date($('#tran-datetime').val()) > new Date()) {
            $('#tran-datetime').val(moment().format('Y-MM-DD HH:mm'))
            alert('เป็นไปไม่ได้!');
        }
    }

    function selectChange() {
        if (document.getElementById('category').value == 'อื่นๆ') {
            document.getElementById('otherCategory').hidden = false;
        } else {
            document.getElementById('otherCategory').hidden = true;
        }

        console.log($('#category').find(':selected').attr('us_id'));
        if ($('#category').find(':selected').attr('us_id')) {
            $('#show-edit-del').removeClass('d-none')
            $('#show-edit-del').addClass('d-flex')
        } else {
            $('#show-edit-del').removeClass('d-flex')
            $('#show-edit-del').addClass('d-none')
        }
    }
</script>
@endsection