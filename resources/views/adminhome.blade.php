@extends('layouts.moneyhub')

@section('main')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <h4><b id="TotalAmount">จำนวนผู้ใช้งาน</b></h4>
    <h5><span id="NormalUser">Normal User: </span></h5>
    <h5><span id="PremiumUser">Premiun User: </span></h5>
    <div id="careerChart" style="height: 370px; width: 100%;"></div>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    <br>
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
                    <td>
                        @if ($user->is_plus == 0)
                            Normal User
                        @else
                            Premium User
                        @endif
                    </td>
                    <td>
                        @if ($user->is_plus == 0)
                            ยังไม่ได้จ่าย
                        @else
                            @if (auth()->user()->is_admin == 1)
                                ผ่านฉลุย
                            @else
                                จ่ายแล้ว
                            @endif
                        @endif
                    </td>
                    @foreach ($payments as $payment)
                        @if ($payment->us_id == $user->id)
                            @if (auth()->user()->is_admin == 1)
                                <td>ผ่านฉลุย</td>
                            @else
                                <td>{{ $payment->payment_datetime }}</td>
                            @endif
                            @break; 
                        @endif
                    @endforeach
                    <td>{{ $user->us_email }}</td>
                    <td class="">
                        <a aria-disabled="{{ $user->is_admin ? 'true' : 'false' }}" class="btn m-0 {{ $user->is_admin ? 'btn-success disabled' : 'btn-outline-success' }}" href="{{ route('moneyhub.grantadmin', ['user_id' => $user->id]) }}" onclick="return confirm('{{ $user->is_admin ? 'Dis admin this user?' : 'Admin this user?' }} ')">
                            {{ $user->is_admin ? 'Admin' : 'Grant' }}
                        </a>
                        <a class="btn btn-danger {{ $user->is_admin ? 'disabled' : '' }}" href="{{ route('moneyhub.deleteuser', ['user_id' => $user->id]) }}" onclick="return confirm('Are you sure you want to delete this user?')">
                            Delete
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <h4><b>คำร้องขอ</b></h4>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">ลำดับที่</th>
                <th scope="col">ชื่อผู้ใช้</th>
                <th scope="col">E-mail</th>
                <th scope="col">คำอธิบาย</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach ($enquiries as $enquiry)
            <tr>
                <th scope="row">{{ $enquiry->id }}</th>
                <td>{{ $enquiry->created_at }}</td>
                <td>{{ $enquiry->contract_name }}</td>
                <td>{{ $enquiry->contract_email }}</td>
                <td>{{ $enquiry->description }}</td>
                <td>
                    <a class="btn btn-outline-danger" href="{{ route('moneyhub.deleteMsg', $enquiry->id) }}" onclick="return confirm('Are you sure you want to delete this message?')">
                        Delete
                    </a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
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
    <script>
        window.onload = function() {
            var careerchart = new CanvasJS.Chart("careerChart", {
                animationEnabled: true,
                title: {
                    text: "User's Career"
                },
                subtitles: [{
                    text: "อาชีพผู้ใช้งาน"
                }],
                data: [{
                    type: "pie",
                    yValueFormatString: "#,##0.00\"\"",
                    indexLabel: "{label} ({y})",
                    dataPoints: <?php echo json_encode($dataCareer, JSON_NUMERIC_CHECK); ?>
                }]
            });
            careerchart.render();
        }
    </script>
@endsection
