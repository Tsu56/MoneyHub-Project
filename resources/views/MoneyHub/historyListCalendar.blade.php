@extends('layouts.moneyhub')

@section('add-link')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
@endsection

@section('main')
    <div class="container">
        <div class="text-center">
            <h2>ปฏิทิน {{ app()->getLocale() }}</h2>
        </div>
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <div id="calendar">
                </div>    
            </div>
            <div class="col-1"></div>
        </div>
    </div>    
    <script>
        $(document).ready(()=>{
            $('#calendar').fullCalendar({
                lang: 'th'
            });
        });
    </script>
@endsection