@extends('layouts.moneyhub')

@section('main')

<section>
    <div class="container-form p-3 my-3 top-50 start-50">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card-header">
                    <h3>ติดต่อสอบถาม</h3>
                </div><br>
                <div class="card-body">
                @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form action="" method="post">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="form-group w-50 p-3" method="POST" action="">
                                <label for="name">ชื่อ<span class="text-danger">*</span></label>
                                <input type="text" name="name" value="{{ auth()->user()->us_fname . ' ' . auth()->user()->us_lname}}" class="form-control" autofocus required>
                                <br>
                                <label for="email">อีเมล<span class="text-danger">*</span></label>                               
                                <input value="{{ auth()->user()->us_email }}" type="email" name="email" class="form-control" required>
                                <br>
                                <label for="msg">ข้อความ</label><br>
                                <textarea class="msg" name="msg" id="msg" required></textarea>
                                <button class="btn-sub" type="submit">ส่งข้อมูล</button>
                                <br>
                                <p class="or"> - Or -</p>
                                <br>
                                <div class="information">
                                    <ul class="contact-info">
                                        <li><strong>วิทยาลัยการคอมพิวเตอร์ มหาวิทยาลัยขอนแก่น </strong><br>
                                        123 อาคารวิทยวิภาส ถ.มิตรภาพ ต.ในเมือง อ.เมืองขอนแก่น จ.ขอนแก่น 40002
                                        </li>
                                        <li><strong>อีเมล:</strong> MoneyHub@email.com</li>
                                        <li><strong>เพจ:</strong> Moneyhub</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>   
        </div>
    </div>
</section>

@endsection

