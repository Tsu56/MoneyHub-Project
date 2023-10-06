@extends('layouts.moneyhub')

@section('main')
<div class="card">
    <img src="{{ asset('img/Banner-3.png') }}" class="card-img-top" alt="โฆษณามันนี่ฮับ">
</div><br><br><br>
<hr><br>

<div class="container mt-3" id="paragraph-1">
    <div class="row">
        <div class="col-md-6">
            <h1 class="py-6">บันทึกง่าย เข้าใจง่าย <br> วางแผนการเงินได้สบาย<br> <span>
                    <h1>กับ MoneyHub</h1>
                </span></h1>
            <ul>
                <li>ช่วยให้คุณดูรายรับ-รายจ่ายได้อย่างเข้าใจ</li>
                <li>จัดการการเงินได้ง่าย และสวยงาม</li>
                <li>ช่วยให้คุณวางแผนการเงิน อย่างเป็นระบบ</li>
                <li>รู้ทุกรายรับ-รายจ่าย วางแผนการเงินได้แม่นยำ</li>
            </ul>
            <a href="{{ route('moneyhub.noteincome', ['user_id' => auth()->user()->id]) }}"><button type="button" class="btn custom-btn-blue">บันทึกรายรับ-รายจ่าย</button></a>
        </div><br>
        <div class="col-md-6">
            <img src="{{ asset('img/ads-house.png') }}" alt="รูปภาพ" class="img-fluid">
        </div>
    </div>
</div><br>
<hr>


<div class="container mt-3">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <img src="{{ asset('img/ads-5.png') }}" class="rounded-circle img-pointer" alt="โฆษณาวงกลม" width="304" height="290">
        </div>
        @if(!auth()->user()->payment_status)
        <div class="col-md-4 mx-auto">
            <a href="{{ route('moneyhub.Qrcode') }}"><img src="{{ asset('img/ads.png') }}" class="rounded-circle img-pointer" alt="โฆษณาวงกลม-2" width="304" height="290"></a>
        </div>
        @endif
        <div class="col-md-4 mx-auto">
            <img src="{{ asset('img/ads-4.png') }}" class="rounded-circle img-pointer" alt="โฆษณาวงกลม-3" width="304" height="290">
        </div>
    </div>
</div><br><br>

<div class="card" id="card-2">
    <a href="{{ route('moneyhub.noteincome', ['user_id' => auth()->user()->id]) }}"><img src="{{ asset('img/Banner-2.png') }}" class="card-img-top" alt="โฆษณามันนี่ฮับ"></a>
</div><br>
<section id="chefs" class="chefs chefs-bg">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h1>เกี่ยวกับเรา</h1>
            <p>โปรเจคต์ของเราสำเร็จด้วยบุคคลเหล่านี้ :</p>
        </div><br>

        <div class="row">

            <div class="col-lg-4 col-md-6">
                <div class="member" data-aos="zoom-in" data-aos-delay="100">
                    <img src="{{ asset('img/friend.jpg') }}" class="img-fluid" alt="">
                    <div class="member-info">
                        <div class="member-info-content">
                            <h3>Sorrawit Phiphan</h3>
                            <span>653380036-1</span>
                        </div>
                        <div class="social">

                            <a href="https://www.facebook.com/bismark2487"><i class="bi bi-facebook"></i></a>
                            <a href="https://www.instagram.com/sorawit.phx/"><i class="bi bi-instagram"></i></a>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="member" data-aos="zoom-in" data-aos-delay="200">
                    <img src="{{ asset('img/title.jpg') }}" class="img-fluid" alt="">
                    <div class="member-info">
                        <div class="member-info-content">
                            <h4>Phukritsakon Yotphiphat</h4>
                            <span>653380035-3</span>
                        </div>
                        <div class="social">

                            <a href="https://www.facebook.com/supawitch.boonkun"><i class="bi bi-facebook"></i></a>
                            <a href="https://instagram.com/phx_title/"><i class="bi bi-instagram"></i></a>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="member" data-aos="zoom-in" data-aos-delay="300">
                    <img src="{{ asset('img/ployy.jpg') }}" class="img-fluid" alt="">
                    <div class="member-info">
                        <div class="member-info-content">
                            <h4>Araya Hongsawong</h4>
                            <span>653380041-8</span>
                        </div>
                        <div class="social">

                            <a href="https://www.facebook.com/profile.php?id=100088538841786"><i class="bi bi-facebook"></i></a>
                            <a href="https://www.instagram.com/bebe.ariix18/"><i class="bi bi-instagram"></i></a>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="member" data-aos="zoom-in" data-aos-delay="200">
                    <img src="{{ asset('img/palm.jpg') }}" class="img-fluid" alt="">
                    <div class="member-info">
                        <div class="member-info-content">
                            <h4>Punyawat Seankort</h4>
                            <span>653380031-1</span>
                        </div>
                        <div class="social">

                            <a href="https://www.facebook.com/profile.php?id=100014322600932"><i class="bi bi-facebook"></i></a>
                            <a href="https://www.instagram.com/dp_plamx.pun/"><i class="bi bi-instagram"></i></a>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="member" data-aos="zoom-in" data-aos-delay="300">
                    <img src="{{ asset('img/far.jpg') }}" class="img-fluid" alt="">
                    <div class="member-info">
                        <div class="member-info-content">
                            <h4>Kingnapa Singharach</h4>
                            <span>653380369-4</span>
                        </div>
                        <div class="social">
                            <a href="https://www.facebook.com/kingnapa.singharach.56"><i class="bi bi-facebook"></i></a>
                            <a href="https://www.instagram.com/skybykx/"><i class="bi bi-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>

        </div><br>

    </div>
</section><br><br><br>

<!-- Play-btn  -->
<section id="hero" class="d-flex align-items-center">
    <div class="container position-relative text-center text-lg-start" data-aos="zoom-in" data-aos-delay="100">
        <div class="row">

            <div class="col-lg-12 d-flex align-items-center justify-content-center position-relative" data-aos="zoom-in" data-aos-delay="200">
                <a href="https://www.youtube.com/watch?v=kO8fhI_-jnA" class="glightbox play-btn"></a>
            </div>

        </div>
    </div>
</section>

<br><br>


@endsection