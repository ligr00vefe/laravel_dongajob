@extends("layouts.layout")

@section("title")
    동아대 마이페이지 - 스터디룸 예약내역
@endsection

@push('scripts')
    <link rel="stylesheet" href="/css/studyroom.css">
    <script type="text/javascript" src="/js/modal.js"></script>
    <script>
        $(document).ready(function () {

            let modalBody = document.querySelector('.modal-body .table01 tbody');
            let modalInfo = document.querySelectorAll('.modal-body .table02 table p');

            $('.td_usePeople a').on('click', function () {

                let parentTr = this.parentNode.parentNode;

                __common.getAjax('GET', '/ajax/studyroom/student', {id: this.parentNode.dataset.id}, function (result) {

                    if (result.status != 200)
                        return;

                    modalInfo[0].textContent = parentTr.querySelector('.td_campus').textContent;
                    modalInfo[1].textContent = parentTr.querySelector('.td_roomName').textContent;
                    modalInfo[2].textContent = parentTr.querySelector('.td_reservedTime').textContent;
                    modalInfo[3].textContent = parentTr.querySelector('.td_password').textContent;
                    modalBody.innerHTML = result.data;

                });

                studyrommModalOpen();
            });

            $('.btn-modal_close').on('click', function () {
                studyrommModalClose();
            });


            $('.btn-deleteReservation').on('click', function () {
                if(confirm('삭제후 복구는 불가능 합니다.\n정말로 삭제하시겠습니까?')) {
                    document.forms.id.value = this.dataset.id;
                    document.forms.submit();
                }
            });


        });
    </script>
@endpush

@php
    $major_menu = "My Page";
    $minor_menu = "스터디룸 예약내역";
@endphp

@section("content")
    <div class="sub-content content-studyroom">
        <div class="sub-content_title">
            <h1>스터디룸 예약내역</h1>
        </div>

        <div class="board-wrap board-list studyroom-list">

            <div class="table-head">
                <span class="no-show">
                    <p>무단 미사용 횟수 : {{ $no_show_cnt }} 회</p>
                </span>
            </div>

            <div class="list-warp table01">
                <form action="/studyroom" method="post" name="forms">
                    @csrf
                    @method("delete")
                    <input type="hidden" name="id" value="">
                    <table class="member-list in-input table-2x-large">
                        <thead>
                        <tr>
                            <th class="th_num">번호</th>
                            <th class="visible-pc">캠퍼스</th>
                            <th class="visible-pc">스터디룸</th>
                            <th class="visible-pc">신청일시</th>
                            <th class="visible-pc">예약일시</th>
                            <th class="visible-tablet">예약내역</th>
                            <th>사용인원</th>
                            <th>비밀번호</th>
                            <th>상태</th>
                            <th>예약삭제</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($lists as $list)
                            <tr>
                                <td class="td_num">{{ $list->id }}</td>
                                <td class="visible-pc td_campus">{{ $list->campus_name }} 캠퍼스</td>
                                <td class="visible-pc td_roomName">{{ $list->room_name }}</td>
                                <td class="visible-pc td_createdAt">{{ $list->created_at }}</td>
                                <td class="visible-pc td_reservedTime">{{ $list->reservatio_date }}</td>
                                <td class="visible-pc td_password">{{ $list->room_password }}</td>
                                {{-- 태블릿 사이즈에만 보이는 값--}}
                                <td class="visible-tablet td_reservationInfo">
                                    <span><b>캠퍼스 : </b><p>{{ $list->campus_name }} 캠퍼스</p></span>
                                    <span><b>스터디룸 : </b><p>{{ $list->room_name }}</p></span>
                                    <span><b>신청일시 : </b><p>{{ $list->created_at }}</p></span>
                                    <span><b>예약일시 : </b><p>{{ $list->reservatio_date }}</p></span>
                                    <span><b>비밀번호 : </b><p>{{ $list->room_password }}</p></span>
                                </td>
                                {{-- 태블릿 사이즈에만 보이는 값--}}
                                <td class="td_usePeople" data-id="{{ $list->id }}">
                                    <a href="javascript:void(0)">{{ count($list->students) }}명</a>
                                </td>
                                <td class="td_status"><p class="res-status_01">{{ $list->status }}</p></td>
                                <td class="td_deleteReservation">
                                    <button type="button"  data-id="{{ $list->id }}" class="btn-deleteReservation">삭제</button>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="100">내역이 존재하지 않습니다.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                    <div class="table-notice">
                        <img src="/img/exclamation_mark.png" class="exclamation-mark" alt="느낌표 아이콘">
                        <p>예약삭제 시 스터디룸 예약이 취소 됩니다.</p>
                    </div>
                </form>
            </div>{{-- //.table01 end --}}

            <article id="list_bottom">
                {{--{!! pagination2(10, ceil($paging/15)) !!}--}}
            </article> <!-- article list_bottom end -->

        </div>{{-- //.body-reservation end --}}

    </div>{{-- //.sub-content.content-studyroom end --}}


    {{-- 스터디룸 예약 list 모달창 --}}
    @include('_include.modal.studyroomModal');

@endsection
