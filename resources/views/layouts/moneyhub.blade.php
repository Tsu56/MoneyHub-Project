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
        <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
        <!-- @fonts.google -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter&family=Kanit&family=Noto+Serif:wght@500&family=Playfair+Display:wght@400;600&family=Varela+Round&display=swap" rel="stylesheet">
    </head>

<body>
    <!-- ***** navbar Area End ***** -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-area navbar-sticky">
        <div class="container">
            <!-- ***** Logo Start ***** -->
            <a href="{{ route('moneyhub.indexhome') }}" class="logo">
                <img src="{{ asset('img/MoneyHub_loco.png') }}" alt="" width="150" height="42">
            </a>
            <!-- ***** Logo End ***** -->
            <!-- ***** button toggler icon Start ***** -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- ***** button toggler icon End ***** -->

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('moneyhub.indexhome') }}">หน้าหลัก</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('moneyhub.noteincome', ['user_id' => auth()->user()->id])}}">รายรับ-รายจ่าย</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="{{ route('moneyhub.indexsummarize') }}" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            สรุป
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">สรุปแผนการเงิน</a></li>
                            <li><a class="dropdown-item" href="#">ประวัติรายการ</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">อื่นๆ</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">ติดต่อเรา</a>
                    </li>
                </ul>
                <!-- ***** search form Start ***** -->
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                <!-- ***** search form End ***** -->
            </div>
        </div>
    </nav><br><br>
    <!-- ***** navbar Area End ***** -->

    <div class="container">
        <main>
            @yield('main')
        </main>
        <footer>
            <span>MoneyHub</span>
            <span>ติดต่อเรา</span>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>