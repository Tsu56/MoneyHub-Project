@extends('layouts.historyList')

@section('sub-content')
    @if(session('refresh'))
        {{ header("Refresh:0") }}
    @endif

    @if (!$trans)
    <br><br>
        <div class="text-center">
            <h1>
                Oops! ไม่มีข้อมูลจ้าาาาา
            </h1><br><br><br><br>
            <a class="btn btn-warning" href="{{ url()->previous() }}">ย้อนกลับ</a>
        </div><br><br><br><br>
       
    @else
        <script>
            getTransactionMonth(new Date('{{ array_keys($trans)[count($trans) - 1] }}'), new Date(
                '{{ array_keys($trans)[0] }}'));
        </script>
          <style>
            tr.hide-table-padding td {
                padding: 0;
            }

            .expand-button {
                position: relative;
            }

            .accordion-toggle .expand-button:after {
                display: flex;
                flex-direction: row;
                justify-content: end;
                margin-right: 2rem;
                content: '-';
            }

            .accordion-toggle.collapsed .expand-button:after {
                content: '+';
            }

            .collapsing {
                -webkit-transition: height .01s ease-in-out;
                transition: height .01s ease-in-out;
            }
        </style><br>
         {{-- ทดสอบโค้ด --}}
        {{-- {{ array_keys($trans)[count($trans)-1] }}
        {{ array_keys($trans)[0] }} --}}

        {{-- Modal Edit --}}
        <div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">แก้ไขธุรกรรม</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('moneyhub.historyList.updateTran') }}" method="get">
                            <input type="hidden" class="form-control" id="tran-id" name="tran-id">
                            <div class="mb-3">
                                <label for="" class="col-form-label">ประเภท:</label>
                                <select class="form-select" name="category" id="category">
                                    @foreach ($categorys as $cate)
                                        <option db-id="{{ $cate->transaction_type_id }}" value="{{ $cate->id }}">
                                            {{ $cate->us_id ? '👤' : '' }} {{ $cate->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="" class="col-form-label">จำนวนเงิน:</label>
                                <input class="form-control" type="number" name="amount" id="amount">
                            </div>
                            <div class="mb-3">
                                <label for="" class="col-form-label">คำอธิบาย:</label>
                                <textarea class="form-control" name="description" id="description"></textarea>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>


        {{-- Modal Delete --}}
        <div class="modal fade" id="modal-delete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">ลบธุรกรรม</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ต้องการลบธุรกรรมวันที่ "<span class="text-danger" id="show-id-delete"></span>" หรือไม่?
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('moneyhub.historyList.delTran') }}" method="get">
                            <input type="hidden" id="id-delete" name="id">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                            <button type="submit" class="btn btn-danger">ลบ</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive border shadow-sm rounded p-3">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col" style="width: 20%;">วันที่ / เวลา</th>
                        <th scope="col" style="width: 20%;">ประเภทธุรกรรม</th>
                        <th scope="col" style="width: 20%;">ประเภท</th>
                        <th scope="col" style="width: 20%;">จำนวนเงิน</th>
                        <th scope="col" style="width: 20%;">คำอธิบาย</th>
                        <th scope="col" class="d-flex justify-content-center"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($trans as $key => $detail)
                        <tr class="table-dark accordion-toggle" aria-expanded="false" data-bs-toggle="collapse"
                            href="#collapse{{ $key }}" role='button' aria-controls="collapse{{ $key }}">
                            <td colspan="5">
                                <script>
                                    document.write(moment('{{ $key }}').format('LL'))
                                </script>
                            </td>
                            <td class="expand-button"></td>
                        </tr>
                        @foreach ($trans[$key]['trans'] as $tran)
                            <tr id="collapse{{ $key }}" class="collapse show">
                                <td>เวลา
                                    <script>
                                        document.write(moment('{{ $tran->created_at }}').format('H:mm:ss'))
                                    </script> น.
                                </td>
                                <td db-id="{{ $tran->transaction_type->id }}">
                                    {{ $tran->transaction_type->transaction_type_name }}</td>
                                <td db-id="{{ $tran->category ? $tran->category->id : '' }}">
                                    {{ $tran->category ? $tran->category->category_name : '-' }}</td>
                                <td><span
                                        class=" {{ $tran->transaction_type->id == 1 ? 'text-success' : 'text-danger' }}">{{ number_format($tran->transaction_amount) }} ฿</span>
                                <td>{{ $tran->transaction_description }}</td>
                                <td>
                                    <div class="d-flex flex-row justify-content-end align-items-center">
                                        {{-- ปุ่มแสดงรายละเอียด --}}
                                        {{-- <button class="btn btn-outline-primary" style="width: 7em;">รายละเอียด</button> --}}

                                        {{-- ปุ่ม edit --}}
                                        <button class="btn btn-outline-warning mx-1" value="{{ $tran->id }}"
                                            id="btn-edit{{ $tran->id }}" type="button">แก้ไข</button>
                                        <script>
                                            $(document).ready(() => {
                                                $('#btn-edit{{ $tran->id }}').click((e) => {
                                                    let select = $('#category').children();
                                                    let prev_amount = $($(e.target).parent().parent().parent().children()[3]).children().text();
                                                    let prev_tran_type_id = $($(e.target).parent().parent().parent().children()[1]).attr(
                                                        'db-id')
                                                    let prev_cate = $($(e.target).parent().parent().parent().children()[2]).attr('db-id')
                                                    let prev_descrip = $($(e.target).parent().parent().parent().children()[4]).text()

                                                    //Reaplce ข้อความใน input
                                                    $('#tran-id').val(e.target.value);
                                                    $('#amount').val(parseFloat(prev_amount.replaceAll(',', '')));
                                                    for (let i = 0; i < select.length; i++) {
                                                        if (prev_tran_type_id == $(select[i]).attr('db-id')) {
                                                            $(select[i]).prop('disabled', false);
                                                            $(select[i]).prop('hidden', false);
                                                        } else {
                                                            $(select[i]).prop('disabled', true);
                                                            $(select[i]).prop('hidden', true);
                                                        }
                                                    }
                                                    $('#category').val(prev_cate);
                                                    $('#description').val(prev_descrip);

                                                    $('#modal-edit').modal('toggle');

                                                });
                                            });
                                        </script>

                                        {{-- ปุ่ม delete --}}
                                        <input type="hidden" name="id" value="{{ $tran->id }}">
                                        <button class="btn btn-outline-danger mx-1" value="{{ $tran->id }}"
                                            id="btn-delete{{ $tran->id }}" type="submit">ลบ</button>
                                        <script>
                                            $(document).ready(() => {
                                                $('#btn-delete{{ $tran->id }}').click((e) => {
                                                    $('#show-id-delete').text( moment('{{ $tran->created_at }}').format('LLLL') + ' น.');
                                                    $('#id-delete').val({{ $tran->id }});
                                                    $('#modal-delete').modal('toggle');
                                                });
                                            });
                                        </script>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div><br>
    @endif

@endsection
