@extends('layouts.moneyhub')

@section('main')

<section id="chefs" class="chefs chefs-bg">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h1>สมาชิก (Members)</h1>
            <p>โปรเจคต์ของเราสำเร็จด้วยบุคคลเหล่านี้</p>
        </div>

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

        </div>

    </div>
</section><!-- End Chefs Section -->



@endsection