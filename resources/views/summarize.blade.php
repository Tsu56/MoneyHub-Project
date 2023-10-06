@extends('layouts.moneyhub')

@section('main')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <div class="container p-5 my-5 text-white custom-pink-container">
        <div>
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="py-6">สรุปแผนการเงิน</h2>
                @if(auth()->user()->payment_status)
                <div>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/exceljs/4.3.0/exceljs.js" integrity="sha512-cGr/NaKGtjxGJokVug48VTo4KNaVgqDxylS4lT5Wi39OFsqfv4J/eMZKOfrcwh/lAnOlK5/P7tEnRkdsbZrxUA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.js" integrity="sha512-UNbeFrHORGTzMn3HTt00fvdojBYHLPxJbLChmtoyDwB6P9hX5mah3kMKm0HHNx/EvSPJt14b+SlD8xhuZ4w9Lg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                    <script>
                        function exportExcel() {
                        const workbook = new ExcelJS.Workbook();
                        console.log(workbook);
                        }
                    </script>
                    <a onclick="exportExcel()" class="btn btn-success">Export Excel</a>
                    <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" class="btn btn-danger">Export PDF</a>
                </div>
                @endif
            </div>
            <hr>
            <h5>เลือกช่วง</h5>

            <form id="datepicker" action="{{ route('moneyhub.getsummarize')}}" method="post">
                @csrf
                <input type="text" name="us_id" value={{auth()->user()->id}} hidden>
                <label for="start">เริ่ม: </label>
                <input type="date" name="startdate" id="startdate" value='{{$StartdateForSetForm}}'>
                <label for="end">สิ้นสุด: </label>
                <input type="date" name="enddate" id="enddate" value='{{$EnddateForSetForm}}'>
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