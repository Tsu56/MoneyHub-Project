@extends('layouts.moneyhub')

@section('main')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                    const transactions = JSON.parse(res).filter(transaction => transaction.transaction_description)
                    $.ajax({
                        headers: {'X-CSRF-token': $("meta[name='csrf-token']").attr('content')},
                        url: '{{ route("moneyhub.exportCSV") }}',
                        type: 'POST',
                        data: {
                            data: JSON.stringify(transactions)
                        },
                        success: function(response){
                            console.log(response);
                        }
                    })
                }
            })
        }
    </script>
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
        <input type="date" name="startdate" id="startdate" value={{$StartdateForSetForm}}>
        <label for="end">สิ้นสุด</label>
        <input type="date" name="enddate" id="enddate" value={{$EnddateForSetForm}}>
        <button type="submit">โอเค</button>
    </form>
    <span>รายรับ {{number_format($Total_income, 2)}}</span><br>
    <span>รายจ่าย {{number_format($Total_expense, 2)}}</span><br>
    <span>สรุปยอด {{number_format($Total_income-$Total_expense, 2)}}</span><br>
    <input type="button" value="Send" onclick="sendExport()">
    <div id="incomechart" style="width: 900px; height: 500px;"></div>
    <div id="expensechart" style="width: 900px; height: 500px;"></div>
</div>

@endsection