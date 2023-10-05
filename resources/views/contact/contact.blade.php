@extends('layouts.moneyhub')

@section('main')

<section>
    <div class="container-form p-3 my-3 top-50 start-50">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card-header">
                    <h3>ติดต่อสอบถาม</h3>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="form-group w-50 p-3">
                                <label for="name">ชื่อ :</label>
                                <input type="text" name="name" class="form-control">
                                <br>
                                <label for="email">อีเมล :</label>                               
                                <input type="email" name="email" class="form-control">
                                <br>
                                <label for="msg">ข้อความ :</label><br>
                                <textarea class="msg" name="msg" id=""></textarea>
                                <button class="btn-sub" type="submit">ส่งข้อมูล</button>
                                <br>
                                <p class="or">Or</p>
                                <br>
                                <a href="https://www.facebook.com/" target="_blank">
                                <ion-icon name="logo-facebook"></ion-icon>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>   
        </div>
    </div>
</section>

@endsection

