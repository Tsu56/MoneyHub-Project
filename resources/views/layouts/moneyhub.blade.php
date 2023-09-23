<html lang="en">

<head lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- @bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <title>MoneyHub ตัวช่วยเก็บเงิน</title>
        <!-- @style.css -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
        <!-- @fonts.google -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Inter&family=Kanit&family=Noto+Serif:wght@500&family=Playfair+Display:wght@400;600&family=Varela+Round&display=swap"
            rel="stylesheet">
        @yield('add-link')
    </head>

<body>
    <!-- ***** navbar Area Start ***** -->
    <nav class="navbar navbar-expand-lg navbar-area navbar-sticky custom-pink-navbar ">
        <div class="container ">
            <!-- ***** Logo Start ***** -->
            <a href="{{ route('home') }}" class="logo">
                <img src="{{ asset('img/Logo_MoneyHub.png') }}" alt="" width="150" height="42">
            </a>
            <!-- ***** Logo End ***** -->

            <!-- ***** Navbar Toggler Start ***** -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- ***** Navbar Toggler End ***** -->

            <!-- ***** Navbar Start ***** -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                    <li class="nav-item">
                        <a class="nav-link text-white 
                        @if (request()->routeIs('moneyhub.indexhome'))
                            active
                        @endif " aria-current="page" href="{{ route('moneyhub.indexhome') }}">หน้าหลัก</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white
                        @if (request()->routeIs('moneyhub.noteincome'))
                            active
                        @endif
                        " href="{{ route('moneyhub.noteincome', ['user_id' => auth()->user()->id]) }}">รายรับ-รายจ่าย</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="{{ route('moneyhub.indexsummarize') }}" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            สรุป
                        </a>
                        <ul class="dropdown-menu custom-pink-dropdown" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item text-white" href="{{ "#" }}">สรุปแผนการเงิน</a></li>
                            <li><a class="dropdown-item text-white" href="{{ route('moneyhub.historyList') }}">ประวัติรายการ</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item text-white" href="#" >อื่นๆ</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">ติดต่อเรา</a>
                    </li>
                </ul>
                <!-- ***** search form Start ***** -->
                <form class="d-flex me-2">
                    <input class="form-control me-2" type="search" placeholder="Search..." aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>

                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            สวัสดี, {{ Auth::user()->us_fname }}
                        </a>
                        <ul class="dropdown-menu custom-pink-navbar">
                            <li><a class="dropdown-item" href="{{ route('profile.show') }}">โปรไฟล์</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                        ลงชื่อออก
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- ***** search form End ***** -->
            </div>
            <!-- ***** Navbar End ***** -->
        </div>
    </nav>
    <!-- ***** navbar Area End ***** -->

    <!-- ***** Container Area Start ***** -->
    <div class="container">
        <main>
            @yield('main')
        </main>
    </div><br><br>
    <!-- ***** Container Area End ***** -->

    <!-- ***** Footer Start ***** -->
    <footer class="custom-pink-footer text-white text-center py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p>&copy; 2023 MoneyHub</p>
                </div>
                <div class="col-md-6">
                    <ul class="list-inline">
                        <li class="list-inline-item "><a href="{{ route('moneyhub.indexhome') }}">หน้าหลัก</a></li>
                        <li class="list-inline-item "><a href="#">เกี่ยวกับเรา</a></li>
                        <li class="list-inline-item "><a href="#">บริการ</a></li>
                        <li class="list-inline-item "><a href="#">ติดต่อเรา</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!-- ***** Footer End ***** -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>