@extends('layouts.moneyhub')

@section('main')
    {{-- Modal แก้ไข --}}
    <div class="modal fade" id="edit-cate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="edit-cate" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">แก้ไข</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('moneyhub.updateCate') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="input-group"></div>
                        <label for="input-cate-name">ประเภท</label>
                        <input type="hidden" name="input-edit-cate-id" id="input-edit-cate-id">
                        <input class="form-control" type="text" name="input-edit-cate-name" id="input-cate-name">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                        <button type="submit" class="btn btn-warning">แก้ไข</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal ลบ --}}
    <div class="modal fade" id="del-cate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="del-cate" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">ต้องการลบหรือไม่?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('moneyhub.delcate') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div>
                            ประเภท "<span class="text-danger" id="show-cate-name"></span>" ใช่หรือไม่?
                            <input type="hidden" name="input-cate-id" id="input-cate-id">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                        <button type="submit" class="btn btn-danger">ลบ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <p class="h2 text-center">บันทึกรายรับ-รายจ่าย</p>
    <!--  select_Group รายรับ-รายจ่าย -->
    <div class="btn-group d-flex justify-content-center bg-yellow">
        <a href="{{ route('moneyhub.noteincome', ['user_id' => auth()->user()->id]) }}">
            <button type="button" class="btn">รายรับ</button>
        </a>
        <a href="{{ route('moneyhub.noteexpense', ['user_id' => auth()->user()->id]) }}">
            <button type="button" class="btn">รายจ่าย</button>
        </a>
    </div>

    <div class="container p-5 my-6 text-white custom-pink-container rounded-5 mt-4 shadow">
        <form action="{{ route('moneyhub.inserttransaction') }}" method="post">
            @csrf
            <p class="h3 text-center">บันทึกรายรับ 💹</p>
            <hr>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <br>
            <!--  ระบุค่าที่จะถูกแสดงในช่องข้อมูล ค่านี้จะเป็นไอดีของผู้ใช้ที่ลงชื่อเข้าใช้ (ใช้ auth()->user()->id เพื่อดึงไอดีผู้ใช้ปัจจุบัน)
                              ช่องข้อมูลนี้ถูกซ่อนแสดงอยู่ ผู้ใช้จะไม่เห็นช่องข้อมูลนี้บนหน้าเว็บ แต่ค่าข้อมูลจะถูกส่งไปยังเซิร์ฟเวอร์เมื่อผู้ใช้ส่งแบบฟอร์ม -->
            <input type="text" name="us_id" value={{ auth()->user()->id }} hidden>
            <input type="text" name="trantype" value=1 hidden>
            <!-- ระบุชื่อฟิลด์ที่จะส่งข้อมูลไปยังเซิร์ฟเวอร์เมื่อผู้ใช้ส่งแบบฟอร์ม value=1 ค่า 1 (ใช้เพื่อแสดงว่าเป็นรายได้) -->

            <label for="typeincome" class="form-label">ประเภทรายรับ :</label>
            <div class="row">
                <div class="col form-floating">
                    <select class="form-select" name="category" id="category" onchange="selectChange()" required>
                        @foreach ($categories as $category)
                            <option {{ $category->us_id ? "us_id={$category->us_id}" : '' }} value="{{ $category->id }}">
                                @if ($category->us_id)
                                    👤
                                @endif
                                <span>
                                    {{ $category->category_name }}
                                </span>
                            </option> <!-- ใช้ในการแสดงชื่อประเภทรายรับจากตัวแปร $category  -->
                        @endforeach
                        <option>อื่นๆ</option>
                    </select>
                    <label for="sel1" class="form-label text-dark">Select type (select one):</label>
                </div>
                <div class="col-2 d-none" id="show-edit-del">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#edit-cate" class="btn btn-warning mx-1"
                        onclick="insertMoEdit()">แก้ไข</button>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#del-cate" class="btn btn-danger mx-1"
                        onclick="insertMoDel()">ลบ</button>
                </div>
            </div>
            <input type="text" class="form-control" placeholder="กรอกประเภทอื่นๆ" name="otherCategory"
                id="otherCategory" hidden>


            <div class="mb-3 mt-3">
                <label for="money" class="form-label">จำนวนเงิน(บาท) :</label>
                <input type="number" step="0.01" class="form-control" id="money" placeholder="00.00"
                    name="amount" required>
            </div>

            <div class="mb-3 mt-3">
                <label for="money" class="form-label">วันที่ :</label>
                <label for="custom-tran-datetime" title="คำเตือน!" data-bs-toggle="popover" data-bs-placement="right"
                    data-bs-content="หากกำหนดเอง จะไม่สามารถกำหนด วินาทีได้!" data-bs-trigger="hover focus">กำหนดเอง
                    :</label>
                <input class="form-check-input" onclick="checkCustomDate()" type="checkbox" name="custom-tran-datetime"
                    id="custom-tran-datetime" title="คำเตือน!" data-bs-toggle="popover" data-bs-placement="right"
                    data-bs-content="หากกำหนดเอง จะไม่สามารถกำหนด วินาทีได้!" data-bs-trigger="hover focus">
                <input title="คำเตือน! หากกำหนดเอง จะไม่สามารถกำหนด วินาที ได้!" type="datetime-local"
                    value="{{ date_format(date_create('now'), 'Y-m-d H:i') }}" onchange="checkDate()"
                    class="form-control" id="tran-datetime" placeholder="00.00" name="tran-datetime" required>
            </div>

            <label for="comment" class="form-label">คำอธิบาย :</label>
            <div class="mb-3 mt-3">
                <textarea class="form-control" rows="5" id="comment" name="description"></textarea>
            </div><br>


            <div class="container text-center">
                <button type="submit" class="btn btn-success mx-auto d-block" id="insert-btn"
                    name="insert-btn">บันทึก</button>
            </div>
        </form>
    </div>


    <script>
        // Enable PopOver
        $(document).ready((e) => {
            const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
            const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(
                popoverTriggerEl))
        });

        // ทำงานเมื่อโหลด doc เสร็จ
        $(document).ready(() => {
            if ($('#custom-tran-datetime:checked').val()) {
                $('#tran-datetime').prop('disabled', false);
            } else {
                $('#tran-datetime').prop('disabled', true);
            }

            let sel = document.getElementById('category')
            let id = "{{ session('cate_id') }}"
            for (let i = 0; i < sel.length; i++) {
                if (sel[i].value == id) {
                    sel[i].selected = true
                    console.log(sel[i])
                }
            }
        });

        // เช็คเมื่อโลหด dom เสร็จ
        $(document).ready(() => {
            if ($('#category').find(':selected').attr('us_id')) {
                console.log('work')
                $('#show-edit-del').removeClass('d-none')
                $('#show-edit-del').addClass('d-flex')
            } else {
                console.log('does not work')
                $('#show-edit-del').removeClass('d-flex')
                $('#show-edit-del').addClass('d-none')
            }
        });

        // Modal แก้ไข
        function insertMoEdit() {
            $('#input-cate-name').val(
                $('#category').find(':selected').text().replaceAll('👤', '').trim()
            );
            $('#input-edit-cate-id').val(
                $('#category').val()
            );


        }

        // Modal ลบ
        function insertMoDel() {
            $('#show-cate-name').text(
                $('#category').find(':selected').text().replaceAll('👤', '').trim()
            );
            $('#input-cate-id').val(
                $('#category').val()
            );
        }

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

            // console.log($('#category').find(':selected').attr('us_id'));
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
