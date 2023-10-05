@extends('layouts.moneyhub')

@section('main')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            @if ($amountOfUser <= 1)
                {
                    $("#TotalAmount").append(' {{ $amountOfUser }} User')
                }
            @else
                {
                    $("#TotalAmount").append(' {{ $amountOfUser }} Users')
                }
            @endif

            @if ($amountNormalUser <= 1)
                {
                    $("#NormalUser").append(' {{ $amountNormalUser }} User')
                }
            @else
                {
                    $("#NormalUser").append(' {{ $amountNormalUser }} Users')
                }
            @endif

            @if ($amountPremiumUser <= 1)
                {
                    $("#PremiumUser").append(' {{ $amountPremiumUser }} User')
                }
            @else
                {
                    $("#PremiumUser").append(' {{ $amountPremiumUser }} Users')
                }
            @endif
        })
    </script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {
            packages: ["corechart"]
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var careerdata = google.visualization.arrayToDataTable([
                ['Career', 'Amount'],
                <?php echo $completelistCareerDataForchart; ?>
            ]);

            var careeroptions = {
                title: 'อาชีพกลุ่มผู้ใช้งาน',
                pieHole: 0.4,
            };

            var careerchart = new google.visualization.PieChart(document.getElementById('careerchart'));
            careerchart.draw(careerdata, careeroptions);
        }
    </script>
    <h4><b id="TotalAmount">จำนวนผู้ใช้งาน</b></h4>
    <h5><span id="NormalUser">Normal User: </span></h5>
    <h5><span id="PremiumUser">Premiun User: </span></h5>
    <div id="careerchart" style="width: 900px; height: 500px;"></div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">ลำดับที่</th>
                <th scope="col">ชื่อผู้ใช้</th>
                <th scope="col">เพศ</th>
                <th scope="col">อาชีพ</th>
                <th scope="col">ประเภทผู้ใช้</th>
                <th scope="col">สถานะการชำระเงิน</th>
                <th scope="col">วัน-เวลาการชำระเงิน</th>
                <th scope="col">E-mail</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach ($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->us_fname }} {{ $user->us_lname }}</td>
                    <td>{{ $user->gender->gender_name }}</td>
                    <td>{{ $user->career->career_name }}</td>
                    <td id="is_plus">{{ $user->is_plus }}</td>
                    <td id="payment_status">{{ $user->payment_status }}</td>
                    <td>{{ $user->payment_datetime }}</td>
                    <td>{{ $user->us_email }}</td>
                    <td><button type="button" class="btn btn-danger">ลบ</button></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
