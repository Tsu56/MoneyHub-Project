@extends('layouts.moneyhub')

@section('main')
    
    <div class="container p-5 my-5 text-white custom-pink-container rounded-5">
        <div>
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="py-6">สรุปแผนการเงิน</h2>
                @if(auth()->user()->is_plus)
                <div>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/exceljs/4.3.0/exceljs.js" integrity="sha512-cGr/NaKGtjxGJokVug48VTo4KNaVgqDxylS4lT5Wi39OFsqfv4J/eMZKOfrcwh/lAnOlK5/P7tEnRkdsbZrxUA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.js" integrity="sha512-UNbeFrHORGTzMn3HTt00fvdojBYHLPxJbLChmtoyDwB6P9hX5mah3kMKm0HHNx/EvSPJt14b+SlD8xhuZ4w9Lg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                    <script>
                        function exportExcel() {
                        const workbook = new ExcelJS.Workbook();
                        const worksheet = workbook.addWorksheet("User data");
                        let headerRow = worksheet.addRow(['วันที่', 'รายรับ(รวม)', 'รายจ่าย(รวม)', 'สรุปยอด']);
                        worksheet.addRow(['{{ $StartdateForSetForm }} - {{$EnddateForSetForm}}', '{{ number_format($Total_income, 2) }}', '{{ number_format($Total_expense, 2) }}', ' {{ number_format($Total_income - $Total_expense, 2) }} ']);
                        workbook.xlsx.writeBuffer().then((buffer) => {
                            const blob = new Blob([buffer], {
                                type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                            });
                            saveAs(blob,'Report สรุป ' + moment().format('MMMM Do YYYY, h:mm:ss a'));
                        });
                        }
                    </script>
                    <a onclick="exportExcel()" class="btn btn-success">Export Excel</a>
                    {{-- <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" class="btn btn-danger">Export PDF</a> --}}
                </div>
                @endif
            </div>
            <hr>
            <h5>เลือกช่วง</h5>
            <form id="datepicker" action="{{ route('moneyhub.getsummarize')}}" method="get">
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
        @if(empty($dataIncome) && empty($dataExpense))
            <div class="alert alert-warning">
                ไม่มีข้อมูลให้ประมวลผล <br>
                <u> กรุณาเลือกช่วงวันที่ </u>
            </div>
        @else
            <div class="show-graph">
                <style>
                    .canvasjs-chart-canvas {
                        border-radius: 2em;
                    }
                    .canvasjs-chart-credit {
                        display: none;
                    }
                </style>
                <div class="mb-5" id="incomechart" style="height: 370px; width: 100%;"></div>
                <div id="expensechart" style="height: 370px; width: 100%;"></div>
                <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
            </div>
        @endif
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