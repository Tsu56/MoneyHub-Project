@inject('qrcode', 'App\Http\Controllers\QrcodeController')
@php
    if($qrcode::checkExpire()) {
        echo "<script>alert('หมดเวลา Premium แล้ววว เธอคงต้องไป~~~')</script>";
        header("Refresh:0");
    };
@endphp

<html lang="en">
<head lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <title>MoneyHub ตัวช่วยเก็บเงิน</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- @bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet" /> --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
        <!-- @style.css -->
        @if(auth()->user()->payment_status)
            <link rel="stylesheet" type="text/css" href="{{ asset('css/premium.css') }}">
        @else
            <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
        @endif
        <!-- @fonts.google -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Inter&family=Kanit&family=Noto+Serif:wght@500&family=Playfair+Display:wght@400;600&family=Varela+Round&display=swap"
            rel="stylesheet">
        <!-- @font-awsome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
            integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
            crossorigin="anonymous" />

        {{-- @monet --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/locale/th.min.js"></script>

        {{-- @jQuery --}}
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        @yield('add-link')
    </head>

<body>
    <!-- ***** navbar Area Start ***** -->
    <nav class="navbar navbar-expand-lg navbar-area navbar-sticky custom-pink-navbar ">
        <div class="container-fluid">
            <!-- ***** Logo Start ***** -->
            <a href="{{ route('home') }}" class="logo">
                <img src="{{ asset('img/Logo_MoneyHub.png') }}" alt="" width="150" height="42">
            </a>
            <!-- ***** Logo End ***** -->

            <!-- ***** Navbar Toggler Start ***** -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- ***** Navbar Toggler End ***** -->

            <!-- ***** Navbar Start ***** -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                    <li class="nav-item">
                        <a class="nav-link text-white 
                        @if (request()->routeIs('moneyhub.indexhome')) active @endif "
                            aria-current="page" href="{{ route('moneyhub.indexhome') }}">หน้าหลัก</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white
                        @if (request()->routeIs('moneyhub.noteincome')) active @endif
                        "
                            href="{{ route('moneyhub.noteincome') }}">รายรับ-รายจ่าย</a>
                    </li>
                    <!--  dropdown-menu start-->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white"
                            href="{{ route('moneyhub.indexsummarize', ['user_id' => auth()->user()->id]) }}"
                            id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            สรุป
                        </a>
                        <ul class="dropdown-menu custom-pink-dropdown" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item"
                                    href="{{ route('moneyhub.indexsummarize', ['user_id' => auth()->user()->id]) }}">สรุปแผนการเงิน</a>
                            </li>
                            <li><a class="dropdown-item"
                                    href="{{ route('moneyhub.historyListReuslt') }}">ประวัติรายการ</a></li>
                        </ul>
                    </li><!--  dropdown-menu End  -->
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{route('moneyhub.about')}}">เกี่ยวกับเรา</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('moneyhub.contact') }}">ติดต่อเรา</a>
                    </li>
                    <li class="nav-item">
                        <a id="adminhome" class="nav-link text-white" href="{{ route('moneyhub.admin') }}"
                            hidden>Admin</a>
                    </li>
                </ul>

                <!--  navbar Profile-LogOut Start -->
                <div class="navbar-nav">
                    @if(auth()->user()->payment_status)
                    <a class="dropdown-item custom-nav-level2" id="time-out" href="{{ route('moneyhub.Qrcode') }}">
                        วันหมดอายุ Premium: 
                        <span id="premium-out"></span>
                    </a>
                        <script>
                            setInterval(function () {
                                $('#premium-out').text(moment('{{ auth()->user()->payment_expired }}').endOf('minus').fromNow());
                                if(moment() >= moment('{{ auth()->user()->payment_expired }}')) {
                                    location.reload();
                                }
                            }, 1000);
                        </script>
                    @endif
                </div>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            สวัสดีคุณ {{ Auth::user()->us_fname }} {{ auth()->user()->payment_status ? '👑' : '' }}
                        </a>
                        <ul class="dropdown-menu custom-pink-navbar">
                            <li><a class="dropdown-item custom-nav-level2"
                                    href="{{ route('profile.show') }}">โปรไฟล์</a></li>
                            @if (!auth()->user()->payment_status)
                                <li><a class="dropdown-item custom-nav-level2"
                                        href="{{ route('moneyhub.Qrcode') }}">อัปเกรดสมาชิก</a></li>
                            @endif
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <a class="dropdown-item custom-nav-level2" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        ลงชื่อออก
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!--  navbar Profile-LogOut End -->
            </div>
            <!-- ***** Navbar End ***** -->
        </div>
    </nav>
    <!-- ***** navbar Area End ***** -->

    <!-- ***** Container Area Start ***** -->
    <div class="container container-item">
        <main>
            @yield('main')
        </main>
    </div>
    <br><br>
    <!-- ***** Container Area End ***** -->

    <!-- ***** Footer Start ***** -->
    <footer class="custom-pink-footer text-white text-center py-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 d-flex justify-content-start">
                    <div class="mx-3">
                        <p class="m-0">&copy; 2023 MoneyHub</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <ul class="list-inline m-0">
                        <li class="list-inline-item "><a href="{{ route('moneyhub.indexhome') }}">หน้าหลัก</a></li>
                        <li class="list-inline-item "><a href="{{route('moneyhub.about')}}">เกี่ยวกับเรา</a></li>
                        <li class="list-inline-item "><a href="{{route('moneyhub.contact')}}">ติดต่อเรา</a></li>
                        <li class="list-inline-item "><a href="#">โทร: 097-0099777</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!-- ***** Footer End ***** -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <script>
        @if (auth()->user()->is_admin == 1)
            {
                document.getElementById('adminhome').hidden = false;
            }
        @endif
    </script>

</body>

</html>
