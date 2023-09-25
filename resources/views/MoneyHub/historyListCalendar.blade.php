@extends('layouts.moneyhub')

@section('add-link')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'th',
                timeZone: 'GMT+7',
                dateClick: function(info) {
                    $('#calendar-form').submit();
                },
                events: {
                    id: 'a',
                    title: 'Helloworld',
                    start: '2023-09-05 00:00:00',
                    end: '2023-09-05 12:00:00'
                }
            });
            calendar.render();
        });
    </script>
@endsection

@section('main')
    <div class="container">
        <div class="card">
            <div class="text-center mt-3">
                <h2>ปฏิทิน</h2>
            </div>
            <div class="row">
                <div class="col-12 px-5">
                    <form action="{{ route('moneyhub.historyListReuslt') }}" method="post" name="calendar-from" id="calendar-form">
                        <div class="mb-5" id="calendar">
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <script>
        $(document).ready(()=>{
            $('#calendar').fullCalendar({
                locale: 'th',
            });
        });
    </script> --}}
@endsection
