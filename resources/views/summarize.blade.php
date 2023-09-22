<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MoneyHub</title>
</head>
<body>
    @section('navigation-menu')
        
    @endsection
    <header>
        <h2>Hello {{auth()->user()->us_fname}}</h2>
    </header>
    <nav>
        <ul>
            <li><a href="">หน้าหลัก</a></li>
            <li><a href="">รายรับ-รายจ่าย</a></li>
            <li><a href="">กระปุกออมสิน</a></li>
            <li><a href="/MoneyHub/summarize">สรุป</a></li>
            <li><a href="">ประวัติ</a></li>
        </ul>
    </nav>
    <main>
        <span>เลือกช่วง</span>
        <form action="" method="post">
            <label for="start">เริ่ม</label>
            <input type="date" name="start-date" id="start-date">
            <label for="end">สิ้นสุด</label>
            <input type="date" name="end-date" id="end-date">
            <button type="submit">โอเค</button>
        </form>
        
    </main>
    <footer>

    </footer>
</body>
</html>