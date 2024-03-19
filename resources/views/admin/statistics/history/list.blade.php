@extends("layouts.admin")

@section("title")
    동아대 관리자 - 통계
@endsection

@push("scripts")
    <script src="/js/admin/board.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script defer src="/js/admin/statistics/history/statistics.js"></script>
@endpush

@section("content")
    <style>
        .chart_box {display: flex}
        .table03 h1 {font-size: 18px; font-weight: bold; margin-bottom: 20px}
        .table03 hr {height: 3px; background: #000; margin-bottom: 20px;}
        .statistics_chart {width: 600px !important; margin-bottom: 100px; margin-right: 50px;}
    </style>


    <section id="" class="list_wrapper">
        <article id="list_head">
            <div class="head-info">
                <h1> 통계</h1>
                <div class="action-wrap">
                    <ul>
                        <li>
                            <button class="btn-black-middle" id="btnexcel" data-name="엑셀" data-id="statistics">엑셀출력
                            </button>
                        </li>
                    </ul>
                </div>
            </div>


        </article> <!-- article list_head end -->

        <article class="table03">

            <h1>방문자수</h1>
            <hr>
            <div class="chart_box">
                <div id="visit_day_chart" class="statistics_chart">
                    <canvas></canvas>
                </div>

                <div id="visit_week_chart" class="statistics_chart" >
                    <canvas></canvas>
                </div>

                <div id="visit_month_chart" class="statistics_chart">
                    <canvas></canvas>
                </div>
            </div>

            <h1>게시판 등록 현황</h1>
            <hr>
            <div class="chart_box">
                <div id="board_day_chart" class="statistics_chart">
                    <canvas></canvas>
                </div>

                <div id="board_week_chart" class="statistics_chart" >
                    <canvas></canvas>
                </div>

                <div id="board_month_chart" class="statistics_chart">
                    <canvas></canvas>
                </div>
            </div>


        </article> <!-- article list_contents end -->
    </section>
@endsection
