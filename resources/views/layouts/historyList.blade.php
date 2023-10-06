@extends('layouts.moneyhub')

@section('add-link')
    {{-- <script src="https://kit.fontawesome.com/e8ac7a3d7b.js" crossorigin="anonymous"></script> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js'></script>
    <style>
        #div-fix {
            position: fixed;
            margin: 2.5em;
            bottom: -4px;
            right: 10px;
        }

        #btn-fix {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 3em;
            height: 3em;
        }

        #svg-pen {
            margin: auto;
            display: block;
        }
    </style>
    <script>
        function getTransactionMonth(start, last) {
            let dateData = {
                start: moment(start).format('YYYY-MM-DD'),
                last: moment(last).format('YYYY-MM-DD')
            };
            $.ajax({
                type: "get",
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('moneyhub.historyListgetMonthTransaction') }}",
                data: dateData,
                dataType: "json",
                success: function(res) {
                    console.log(res);
                    $('#show-date').text(`${moment(start).format('LL')} ถึง ${moment(last).format('LL')}`);
                    if(res.analy.balance > 0) {
                        $('#show-sumarize').removeClass('text-danger');
                        $('#show-sumarize').addClass('text-success');
                    }else {
                        $('#show-sumarize').removeClass('text-success');
                        $('#show-sumarize').addClass('text-danger');

                    }
                    $('#show-sumarize').text(`${ (res.analy.balance).toLocaleString('th-TH') } ฿`);
                    $('#show-income').text(`${ (res.analy.income).toLocaleString('th-TH') } ฿`);
                    $('#show-expense').text(`${ (res.analy.expense).toLocaleString('th-TH') } ฿`);
                }
            });
        }

        $(document).ready((e)=> {
            const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
            const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
        });
    </script>
    @yield('sub-script')
@endsection

@section('main')
    {{-- Fix Button --}}
    <div id="div-fix">
        <a class="btn btn-info rounded-circle tt" href="{{ route('moneyhub.noteincome', auth()->user()->id) }}" id="btn-fix"
            data-bs-toggle="popover" data-bs-placement="left" data-bs-content="เพิ่มรายการ" data-bs-trigger="hover focus">
            <svg id="svg-pen" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-pencil-fill">
                <path
                    d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
            </svg>
        </a>
    </div>
    <div class="container">
        {{-- Header Content --}}
        <div class="">
            <div class="text-center mt-3 mb-3">
                <div>
                    {{-- <button class="btn" id="my-button">Get Date</button> --}}
                </div>
                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                    <a class="btn btn-outline-warning {{ request()->routeIs('moneyhub.historyListReuslt') ? 'active' : '' }}"
                        href="{{ route('moneyhub.historyListReuslt') }}">รายการ</a>
                    <a class="btn btn-outline-warning {{ request()->routeIs('moneyhub.historyList') ? 'active' : '' }}"
                        href="{{ route('moneyhub.historyList') }}">ปฏิทิน</a>
                </div>
            </div>
            <div class="mb-3">
                <div class="table-responsive">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th>วันที่</th>
                                <th>ยอดเงินคงเหลือ</th>
                                <th>รายได้</th>
                                <th>รายจ่าย</th>
                            </tr>
                        </thead>
                        <tbody>
                            <td> <span id="show-date"></span> </td>
                            <td><span id="show-sumarize"></span></td>
                            <td><span id="show-income"></span></td>
                            <td><span id="show-expense"></span></td>
                        </tbody>
                    </table>
                </div>
            </div>


            {{-- Main Content --}}
            <div class="row">
                <style>
                    .fc-daygrid-day-number,
                    .fc-col-header-cell-cushion {
                        text-decoration: none;
                        color: black;
                    }
                </style>
                <div class="col-12 px-5">
                    <div class="content">
                        {{-- <div class="mb-5" id="calendar"></div> --}}
                        @yield('sub-content')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
