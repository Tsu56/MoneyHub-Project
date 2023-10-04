<html lang="en">

<head lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <title>MoneyHub ตัวช่วยเก็บเงิน</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- @bootstrap -->
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
        <!-- @style.css -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
        <!-- @fonts.google -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Inter&family=Kanit&family=Noto+Serif:wght@500&family=Playfair+Display:wght@400;600&family=Varela+Round&display=swap"
            rel="stylesheet">
            <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
            <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
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
                            href="{{ route('moneyhub.noteincome', ['user_id' => auth()->user()->id]) }}">รายรับ-รายจ่าย</a>
                    </li>
                    <!--  dropdown-menu start-->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="{{ route('moneyhub.indexsummarize', ['user_id' => auth()->user()->id]) }}" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            สรุป
                        </a>
                        <ul class="dropdown-menu custom-pink-dropdown" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item custom-dropdown" href="{{ route('moneyhub.indexsummarize', ['user_id' => auth()->user()->id]) }}">สรุปแผนการเงิน</a></li>
                            <li><a class="dropdown-item custom-dropdown" href="{{ route('moneyhub.historyList') }}">ประวัติรายการ</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item custom-dropdown" href="#">อื่นๆ</a></li>
                        </ul>
                    </li>
                    <!--  dropdown-menu End  -->
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{route('moneyhub.contact')}}">ติดต่อเรา</a>
                    </li>
                    <li class="nav-item">
                        <a id="adminhome" class="nav-link text-white" href="{{route('moneyhub.admin')}}" hidden>Admin</a>
                    </li>
                </ul>
        
                <!--  navbar Profile-LogOut Start -->
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            สวัสดีคุณ {{ Auth::user()->us_fname }}
                        </a>
                        <ul class="dropdown-menu custom-pink-navbar">
                            <li><a class="dropdown-item custom-nav-level2" href="{{ route('profile.show') }}">โปรไฟล์</a></li>
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
    <br><br><br>
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
    <script>
        if ({{auth()->user()->is_admin}} == 1) {
            document.getElementById('adminhome').hidden = false;
        }
    </script>
</body>

</html>
