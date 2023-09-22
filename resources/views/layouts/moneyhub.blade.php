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
</head>
<body>
    <header>
        <ul>
            <li class="logo">
                <img src="{{ url('img/logo.png')}}" alt="Logo">
            </li>
        </ul>
    </header>
    <nav>
        <ul>
            <li><a href="{{ route('moneyhub.indexhome')}}">หน้าหลัก</a></li>
            <li><a href="{{ route('moneyhub.noteincome', ['user_id' => auth()->user()->id])}}">รายรับ-รายจ่าย</a></li>
            <li><a href="{{ route('moneyhub.indexsummarize')}}">สรุป</a></li>
            <li><a href="">ประวัติ</a></li>
        </ul>
    </nav>
    <main>
        @yield('main')
    </main>
    <footer>
        <span>MoneyHub</span>
        <span>ติดต่อเรา</span>
    </footer>
</body>
</html>