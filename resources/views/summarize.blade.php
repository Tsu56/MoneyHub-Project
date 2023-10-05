@extends('layouts.moneyhub')

@section('main')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <div class="container p-5 my-5 text-white custom-pink-container">
        <div>
            <h2 class="py-6">สรุปแผนการเงิน</h2>
            <hr>
            <h5>เลือกช่วง</h5>

            <form id="datepicker" action="{{ route('moneyhub.getsummarize')}}" method="post">
                @csrf
                <input type="text" name="us_id" value={{auth()->user()->id}} hidden>
                <label for="start">เริ่ม: </label>
                <input type="date" name="startdate" id="startdate" value={{$StartdateForSetForm}}>
                <label for="end">สิ้นสุด: </label>
                <input type="date" name="enddate" id="enddate" value={{$EnddateForSetForm}}>
                <button type="submit" class="btn btn-success" id="insert-btn" name="insert-btn">ตกลง</button>
            </form><br>

            <span>รายรับ {{number_format($Total_income, 2)}} บาท</span><br>
            <span>รายจ่าย {{number_format($Total_expense, 2)}} บาท</span><br>
            <span id="summ">สรุปยอด {{number_format($Total_income-$Total_expense, 2)}} บาท</span>
        </div>

        <br><br>
        <div id="incomechart" style="height: 370px; width: 100%;"></div>
        <div id="expensechart" style="height: 370px; width: 100%;"></div>
        <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    </div>
    <script>
        function sendExport(){
            let data = {
                Start: $("#startdate").val(), 
                End: $("#enddate").val()
            }

            $.ajax({
                headers: {'X-CSRF-token': $("meta[name='csrf-token']").attr('content')},
                url: "{{ route('moneyhub.gettransaction')}}",
                type: "POST",
                dataType: "json",
                data: data,
                success: function(res){
                    console.log(res);
                }
            })
        }
    </script>
    <script>
        window.onload = function() {
            var incomechart = new CanvasJS.Chart("incomechart", {
                animationEnabled: true,
                title: {
                    text: "Income"
                },
                subtitles: [{
                    text: "รายได้"
                }],
                data: [{
                    type: "pie",
                    yValueFormatString: "#,##0.00\"\"",
                    indexLabel: "{label} ({y})",
                    dataPoints: <?php echo json_encode($dataIncome, JSON_NUMERIC_CHECK); ?>
                }]
            });
            var expensechart = new CanvasJS.Chart("expensechart", {
                animationEnabled: true,
                title: {
                    text: "Expense"
                },
                subtitles: [{
                    text: "รายจ่าย"
                }],
                data: [{
                    type: "pie",
                    yValueFormatString: "#,##0.00\"\"",
                    indexLabel: "{label} ({y})",
                    dataPoints: <?php echo json_encode($dataExpense, JSON_NUMERIC_CHECK); ?>
                }]
            });
            incomechart.render();
            expensechart.render();
        }
    </script>
@endsection