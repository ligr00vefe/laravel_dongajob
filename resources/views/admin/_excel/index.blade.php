@extends("layouts/admin")

@section("title")
    엑셀 다운로드
@endsection

@push("scripts")

@endpush

@section("content")

    @php
    //dd($_REQUEST);
    if($_REQUEST['data_type'] == '1'){
//        var_dump(1);
        $data_type = ($_REQUEST['data_type'] != 'undefined' && $_REQUEST['data_type'] != '') ? '&data_type='.$_REQUEST['data_type'] : '&data_type=';
        $from = ($_REQUEST['from'] != 'undefined' && $_REQUEST['from'] != '') ? '&from='.$_REQUEST['from'] : '&from=';
        $to = ($_REQUEST['to'] != 'undefined' && $_REQUEST['to'] != '') ? '&to='.$_REQUEST['to'] : '&to=';
        //$campus = ($_REQUEST['campus'] != 'undefined' && $_REQUEST['campus'] != '') ? '&campus='.$_REQUEST['campus'] : '&campus=';
        $room = ($_REQUEST['room'] != 'undefined' && $_REQUEST['room'] != '') ? '&room='.$_REQUEST['room'] : '&room=';
        $type = ($_REQUEST['type'] != 'undefined' && $_REQUEST['type'] != '') ? '&type='.$_REQUEST['type'] : '&type=';
        $date = ($_REQUEST['date'] != 'undefined' && $_REQUEST['date'] != '') ? '&date='.$_REQUEST['date'] : '&date=';
        $schedule_date = ($_REQUEST['schedule_date'] != 'undefined' && $_REQUEST['schedule_date'] != '') ? '&schedule_date='.$_REQUEST['schedule_date'] : '&schedule_date=';
        $schedule_end_date = ($_REQUEST['schedule_end_date'] != 'undefined' && $_REQUEST['schedule_end_date'] != '') ? '&schedule_end_date='.$_REQUEST['schedule_end_date'] : '&schedule_end_date=';
        $keyword = ($_REQUEST['keyword'] != 'undefined' && $_REQUEST['keyword'] != '') ? '&keyword='.$_REQUEST['keyword'] : '&keyword=';
        $term = ($_REQUEST['term'] != 'undefined' && $_REQUEST['term'] != '') ? '&term='.$_REQUEST['term'] : '&term=';
    }else{
//        var_dump(2);
        $data_type = ($_REQUEST['data_type'] != 'undefined' && $_REQUEST['data_type'] != '') ? '&data_type='.$_REQUEST['data_type'] : '&data_type=';
        $from = ($_REQUEST['from'] != 'undefined' && $_REQUEST['from'] != '') ? '&from='.$_REQUEST['from'] : '&from=';
        $to = ($_REQUEST['to'] != 'undefined' && $_REQUEST['to'] != '') ? '&to='.$_REQUEST['to'] : '&to=';
        //$campus = ($_REQUEST['campus'] != 'undefined' && $_REQUEST['campus'] != '') ? '&campus='.$_REQUEST['campus'] : '&campus=';
    }
       // $term = ($_REQUEST['term'] != 'undefined' && $_REQUEST['term'] != '') ? '&term='.$_REQUEST['term'] : '';
    //dd($url);
    @endphp

    <div class="contents-body">

        <section class="excel-reason">

            <div class="reason-wrap">

                <form action="/{{ ADMIN_URL }}/excel/export{{ $url }}{{$from}}{{$to}}{{$data_type ?? ''}}{{$room ?? ''}}{{$type ?? ''}}{{$date ?? ''}}{{$schedule_date ?? ''}}{{$schedule_end_date ?? ''}}{{$keyword ?? ''}}{{$term ?? ''}}" method="post" name="forms">
                    @csrf
                    <p>
                         위해 출력사유를 입력하셔야 엑셀 다운로드 가능합니다
                    </p>
                    <input name="reason" type="text" placeholder="출력사유를 입력해 주십시오">
                    <button type="button" onclick="validation()">
                        <i class="fa fa-file-download"></i>
                        엑셀 다운로드
                    </button>

                </form>

            </div>

        </section>

        <script>
            function validation() {
                var f = document.forms;
                if (f.reason.value == "") {
                    alert("사유를 입력해주세요", 'error');
                    return false;
                }

                f.submit();

            }
        </script>

    </div>{{-- .contents-body end --}}

    <style>
        .excel-reason {
            width: 100%;
            height: 70vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .excel-reason p {

            font-family: "paybooc-Bold";
            font-size: 16px;
            color: #555555;
            margin-bottom: 10px;

        }

        .excel-reason input {
            width: 400px;
            height: 56px;
            padding: 0 24px;
            font-size: 16px;
        }

        .excel-reason button {
            width: 200px;
            height: 56px;
            border: none;
            background-color: #01387F;
            font-size: 16px;
            color: white;
        }

        .excel-reason button i {
            margin-right: 5px;
        }

    </style>

@endsection
