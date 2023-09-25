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
                selectable: true,
                selectHelper: true,
                dateClick: function(info) {
                    $('#show-pre-date').html(`ของวันที่ ${info.dateStr} หรือไม่`);
                    $('#confirmModal').modal('toggle');
                    $('#closeModalBtn1').click(() => {
                        $('#confirmModal').modal('hide')
                    });
                    $('#closeModalBtn2').click(() => {
                        $('#confirmModal').modal('hide')
                    });
                    $('#confirmModalBtn').click(() => {
                        $('#user-id').val({{ auth()->user()->id }});
                        $('#select-date').val(info.dateStr);
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
                ]
            });
            calendar.render();
        });
    </script>
@endsection

@section('main')
    <!-- Modal -->
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeModalBtn2">ปืด</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="card">
            <div class="text-center mt-3">
                <h2>ปฏิทิน</h2>
            </div>
            <div class="row">
                <div class="col-12 px-5">
                    <div class="mb-5" id="calendar">
                    </div>
                </div>
            </div>
        </div>
        <div id="show-transaction">
        </div>
        <form action="{{ route('moneyhub.historyListReuslt') }}" method="post" id="select-date-form">
            @csrf
            <input type="hidden" name="user-id" id="user-id">
            <input type="hidden" name="select-date" id="select-date">
        </form>
    </div>
@endsection
