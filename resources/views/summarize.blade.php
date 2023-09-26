@extends('layouts.moneyhub')

@section('main')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {packages:["corechart"]});
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
    <span>เลือกช่วง</span>
    <form action="{{ route('moneyhub.getsummarize')}}" method="post">
        @csrf
        <input type="text" name="us_id" value={{auth()->user()->id}} hidden>
        <label for="start">เริ่ม</label>
        <input type="date" name="startdate" id="startdate">
        <label for="end">สิ้นสุด</label>
        <input type="date" name="enddate" id="enddate">
        <button type="submit">โอเค</button>
    </form>
    <span>รายรับ {{number_format($Total_income, 2)}}</span><br>
    <span>รายจ่าย {{number_format($Total_expense, 2)}}</span><br>
    <span>สรุปยอด {{number_format($Total_income-$Total_expense, 2)}}</span>
    <div id="incomechart" style="width: 900px; height: 500px;"></div>
    <div id="expensechart" style="width: 900px; height: 500px;"></div>
@endsection