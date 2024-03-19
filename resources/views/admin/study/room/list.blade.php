@extends("layouts.admin")

@section("title")
    동아대 관리자 - 스터디룸 관리
@endsection

@push('scripts')
    <script src="/js/admin/study/room/list.js"></script>
@endpush

@section("content")
    <section id="" class="list_wrapper">
        <article id="list_head">
            <div class="head-info">
                <h1>스터디룸 관리</h1>
                <div class="action-wrap">
                    <ul>
                        <li>
                            <button class="btn-black-middle" id="btndel" data-name="삭제">선택삭제</button>
                        </li>
                       {{-- <li>
                            <form action="/{{ ADMIN_URL }}/excel/export/study/room" method="post" name="excel">
                                @csrf
                                <button class="btn-black-middle" id="btnexcel" data-name="엑셀">엑셀출력</button>
                            </form>
                        </li>--}}
                        <li>
                            <button class="btn-black-middle" id="btnregister" data-name="등록">신규등록</button>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="campus_info">
                <span data-name="승학">승학 캠퍼스</span>
                <span data-name="부민">부민 캠퍼스</span>
            </div>

        </article> <!-- article list_head end -->

        <!-- 승학 캠퍼스 -->
        <article id="seunghak" class="table03" data-campus="승학">
            <form action="/{{ ADMIN_URL }}/study/room/delete_all" method="post" name="forms">
                @csrf
                @method("delete")
                <table>
                    <colgroup>
                        <col width="3%">
                        <col width="5%">
                        <col width="13%">
                        <col width="13%">
                        <col width="24%">
                        <col width="8%">
                        <col width="8%">
                        <col width="8%">
                        <col width="10%">
                        <col width="8%">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>
                            <input type="checkbox" class="check_all" name="check_all" value="1">
                        </th>
                        <th>번호</th>
                        <th>스터디룸</th>
                        <th>장소</th>
                        <th>시간설정</th>
                        <th>사용가능 여부</th>
                        <th>수용인원</th>
                        <th>최소신청</th>
                        <th>사무기기</th>
                        <th>스터디룸 IP</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($seunghaks as $list)
                        <tr>
                            <td><input type="checkbox" name="chk[]" class="_chk" value="{{ $list->id }}"></td>
                            <td>{{ ($seunghaks->total()-$loop->index)-(($seunghaks->currentpage()-1) * $seunghaks->perpage() )  }}</td>
                            <td><a href="/{{ ADMIN_URL }}/study/room/{{ $list->id }}/edit">{{ $list->name }}</a></td>
                            <td>{{ $list->location }}</td>
                            <td>{{ $list->time }}</td>
                            <td>{!! show_use_data($list->use, 'html') !!}</td>
                            <td>{{ $list->max_personnel }}명</td>
                            <td>{{ $list->min_personnel }}명</td>
                            <td>{{ $list->office_equipment }}</td>
                            <td>{{ $list->room_ip }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100">내역이 존재하지 않습니다.</td>
                        </tr>
                    @endforelse

                    </tbody>
                </table>
            </form>

            <div class="paging-wrap">
                {{ $seunghaks->appends(['campus' => '1'])->links("vendor.pagination.default") }}
            </div>

        </article> <!-- article list_contents end -->

        <!-- 부민 캠퍼스 -->
        <article id="bumin" class="table03" data-campus="부민">
            <form action="/{{ ADMIN_URL }}/study/room/delete_all" method="post" name="forms">
                @csrf
                @method("delete")
                <table>
                    <colgroup>
                        <col width="3%">
                        <col width="5%">
                        <col width="13%">
                        <col width="13%">
                        <col width="24%">
                        <col width="8%">
                        <col width="8%">
                        <col width="8%">
                        <col width="10%">
                        <col width="8%">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>
                            <input type="checkbox" class="check_all" name="check_all" value="1">
                        </th>
                        <th>번호</th>
                        <th>스터디룸</th>
                        <th>장소</th>
                        <th>시간설정</th>
                        <th>사용가능 여부</th>
                        <th>수용인원</th>
                        <th>최소신청</th>
                        <th>사무기기</th>
                        <th>스터디룸 IP</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($bumins as $list)
                        <tr>
                            <td><input type="checkbox" name="chk[]" class="_chk" value="{{ $list->id }}"></td>
                            <td>{{ ($bumins->total()-$loop->index)-(($bumins->currentpage()-1) * $bumins->perpage() )  }}</td>
                            <td><a href="/{{ ADMIN_URL }}/study/room/{{ $list->id }}/edit">{{ $list->name }}</a></td>
                            <td>{{ $list->location }}</td>
                            <td>{{ $list->time }}</td>
                            <td>{!! show_use_data($list->use, 'html')  !!}</td>
                            <td>{{ $list->max_personnel }}명</td>
                            <td>{{ $list->min_personnel }}명</td>
                            <td>{{ $list->office_equipment }}</td>
                            <td>{{ $list->room_ip }}</td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="100">내역이 존재하지 않습니다.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </form>
            <div class="paging-wrap">
                {{ $bumins->appends(['campus' => '2'])->links("vendor.pagination.default") }}
            </div>
        </article> <!-- article list_contents end -->


    </section>
@endsection



