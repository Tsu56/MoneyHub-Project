{{-- @extends('layouts.moneyhub') --}}
@extends('layouts.historyList')

{{-- @section('add-link')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/locale/th.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js'></script>
@endsection --}}

@section('sub-content')
    <div class="modal" tabindex="-1" role="dialog" id="confirmModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">คุณต้องการแสดงรายละเอียด</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModalBtn1">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><span id="show-pre-date"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="confirmModalBtn">เลือก</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeModalBtn2">ปิด</button>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-5" id="calendar"></div>
    <form action="{{ route('moneyhub.historyListReuslt') }}" method="get" id="select-date-form">
        @csrf
        <input type="hidden" name="start_date" id="start_date">
        <input type="hidden" name="end_date" id="end_date">
    </form>
@endsection


@section('sub-script')
<script>
    function calulateTransac(cal) {
        var date_current = cal.getDate();
        var date_startMonth = new Date(date_current.getFullYear(), date_current
            .getMonth(), 1);
        var date_lastMonth = new Date(date_current.getFullYear(), date_current
            .getMonth() + 1, 0);
        getTransactionMonth(date_startMonth, date_lastMonth);
    }

    document.addEventListener('DOMContentLoaded', function() {
        const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
        const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))


        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'th',
            timeZone: 'Asia/Bangkok',
            selectable: true,
            selectHelper: true,
            select: (info) => {
                let start = moment(new Date(info.start.getFullYear(), info.start.getMonth(), info.start.getDate(), 0) );
                let end = moment( new Date(info.end.getFullYear(), info.end.getMonth(), info.end.getDate()-1, 23, 59, 59));
                console.log(  );
                if( (new Date(info.start.getFullYear(), info.start.getMonth(), info.start.getDate()).toString()) ==  (new Date(info.end.getFullYear(), info.end.getMonth(), info.end.getDate()-1).toString()) ) {
                    $('#show-pre-date').html(
                        `ของวันที่ '${ start.format('LL') }' หรือไม่`);
                }else {
                    $('#show-pre-date').html(
                        `ของวันที่ '${ start.format('LL') } ถึงวันที่ ${ end.format('LL') }' หรือไม่`);
                }
                $('#confirmModal').modal('toggle');
                $('#closeModalBtn1').click(() => {
                    $('#confirmModal').modal('hide')
                });
                $('#closeModalBtn2').click(() => {
                    $('#confirmModal').modal('hide')
                });
                $('#confirmModalBtn').click(() => {
                    $('#user-id').val({{ auth()->user()->id }});
                    $('#start_date').val(start);
                    $('#end_date').val(end);
                    $('#select-date-form').submit();
                });
            },
            events: [
                @foreach ($transac_cal_table as $key => $val)
                    @if ($val['expense'] != 0)
                        {
                            title: 'รายจ่าย {{ number_format($val['expense']) }} ฿',
                            start: '{{ $key }}',
                            color: '#FFA07A'
                        },
                    @endif
                    @if ($val['income'] != 0)
                        {
                            title: 'รายรับ {{ number_format($val['income']) }} ฿',
                            start: '{{ $key }}',
                            color: '#9ACD32'
                        },
                    @endif
                    @if ($val['balance'] >= 0)
                        {
                            title: 'ยอดเงิน {{ number_format($val['balance']) }} ฿',
                            start: '{{ $key }}',
                            color: '#8FBC8F'
                        },
                    @else
                        {
                            title: 'ยอดเงิน {{ number_format($val['balance']) }} ฿',
                            start: '{{ $key }}',
                            color: '#F08080'
                        },
                    @endif
                @endforeach
            ],
            customButtons: {
                prev: {
                    text: 'Prev',
                    click: () => {
                        calendar.prev();
                        calulateTransac(calendar);
                    }
                },
                next: {
                    text: 'Next',
                    click: () => {
                        calendar.next();
                        calulateTransac(calendar);
                    }
                },
                today: {
                    text: 'Today',
                    click: () => {
                        calendar.today();
                        calulateTransac(calendar);
                    }
                }
            }
        });
        calendar.render();
        calulateTransac(calendar);
    });
</script>

@endsection
