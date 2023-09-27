@extends('layouts.moneyhub')

@section('main')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load("current", {
        packages: ["corechart"]
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var incomedata = google.visualization.arrayToDataTable([
            ['Category', 'Amount of Income'],
            <?php echo $completeIncomeDataForchart; ?>
        ]);

        var expensedata = google.visualization.arrayToDataTable([
            ['Category', 'Amount of Expense'],
            <?php echo $completeExpenseDataForchart; ?>
        ]);

        var incomeoptions = {
            title: 'รายได้',
            pieHole: 0.4,
        };

        var expenseoptions = {
            title: 'ค่าใช้จ่าย',
            pieHole: 0.4,
        };

        var incomechart = new google.visualization.PieChart(document.getElementById('incomechart'));
        incomechart.draw(incomedata, incomeoptions);

        var expensechart = new google.visualization.PieChart(document.getElementById('expensechart'));
        expensechart.draw(expensedata, expenseoptions);
    }
</script>


<div class="container p-5 my-5 text-white custom-pink-container">
    <div class="col-md-8">
        <h2 class="py-6">สรุปแผนการเงิน</h2>
        <h5>เลือกช่วง</h5>

        <form class="row">
            <label for="date" class="col-1 col-form-label">Date</label>
            <div class="col-5">
                <div class="input-group date" id="datepicker">
                    <input type="text" class="form-control" id="date" />
                    <span class="input-group-append">
                        <span class="input-group-text bg-light d-block">
                            <i class="fa fa-calendar"></i>
                        </span>
                    </span>
                </div>
            </div>
        </form>

        <form action="{{ route('moneyhub.getsummarize')}}" method="post">
            @csrf
            <input type="text" name="us_id" value={{auth()->user()->id}} hidden>
            <label for="start">เริ่ม</label>
            <input type="date" name="startdate" id="startdate">
            <br>
            <label for="end">สิ้นสุด</label>
            <input type="date" name="enddate" id="enddate">
            <br>
            <div class="container text-center">
                <button type="submit" class="btn btn-success mx-auto d-block" id="insert-btn" name="insert-btn">ตกลง</button>
            </div>
        </form>
        <span>รายรับ {{number_format($Total_income, 2)}}</span><br>
        <span>รายจ่าย {{number_format($Total_expense, 2)}}</span><br>
        <span>สรุปยอด {{number_format($Total_income-$Total_expense, 2)}}</span>
    </div>

    <br><br>
    <div id="incomechart" style="width: 900px; height: 500px;"></div>
    <div id="expensechart" style="width: 900px; height: 500px;"></div>
</div>

@endsection