<html lang="en">
<head lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <title>MoneyHub</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
</head>
<body>
<<<<<<< HEAD
    <div class="container">
        <header class="navbar navbar-expand-lg navbar-light bg-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <img class="navbar-brand img-thumbnail" src="/img/cp-logo.png" width="20%" alt="Logo">
                </li>
            </ul>
        </header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link active" href="{{ route('moneyhub.home') }}">หน้าหลัก</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('moneyhub.noteincome', ['user_id' => auth()->user()->id])}}">รายรับ-รายจ่าย</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('moneyhub.summarize') }}">สรุป</a></li>
                <li class="nav-item"><a class="nav-link" href="">ประวัติ</a></li>
            </ul>
        </nav>
        <main>
            @yield('main')
        </main>
        <footer>
            <span>MoneyHub</span>
            <span>ติดต่อเรา</span>
        </footer>
    </div>
</body>
</html>