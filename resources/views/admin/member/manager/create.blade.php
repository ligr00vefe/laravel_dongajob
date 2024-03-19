@extends("layouts.admin")

@section("title")
    동아 관리자대 - 관리자 {{ isset($list) ? '수정' : '등록'  }}
@endsection

@push("scripts")
    <script src="/js/admin/member/manager/create.js"></script>
@endpush

@section("content")

    @php
        $menu_list = get_admin_menu_list();
    @endphp

    <section id="board_section" class="list_wrapper">
        <article id="list_head">

            <div class="head-info">
                <h1>관리자 {{ isset($list) ? '수정' : '등록' }}</h1>
            </div>


            <div class="table02">
                <h2>회원정보</h2>
                <form action="" method="post" name="forms">
                    @csrf
                    @if (isset($list))
                        @method("put")
                        <input type="hidden" name="id" value="{{ $list->id }}">
                    @endif
                    <input type="hidden" name="permit" value="0">
                    <table>
                        <tr>
                            <th>아이디</th>
                            <td>
                                <input type="text" class="_vali" data-title="아이디" name="account" value="{{ $list->account ?? '' }}"  minlength="4" maxlength="12" {{ isset($list) ? 'disabled' : '' }}>
                                <span id="id_ox"></span>
                            </td>
                        </tr>
                        <tr>
                            <th>비밀번호</th>
                            <td>
                                <input type="password" class="{{ !isset($list) ? '_vali' : ''  }}" data-title="비밀번호" name="password" minlength="9" maxlength="15">
                            </td>
                        </tr>
                        <tr>
                            <th>접속IP</th>
                            <td>
                                <input type="text" name="ip" data-title="IP" value="{{ $list->ip ?? '' }}">
                            </td>
                        </tr>
                        <tr>
                            <th>이름</th>
                            <td>
                                <input type="text" class="_vali" data-title="이름" name="name" value="{{ $list->name ?? '' }}" maxlength="15" oninput="maxLengthCheck(this)">
                            </td>
                        </tr>
                        <tr>
                            <th>사용가능메뉴</th>
                            <td>
                                <ul>
                                    @foreach($menu_list as $key => $val)
                                        <li class="checkbox_txt_wrap">
                                            <input type="checkbox" id="menu_{{$key}}" class="_vali input_checkbox" data-title="사용가능메뉴" name="menu[]" value="{{$key}}"
                                                {{ isset($list) && in_array($key, explode(',', $list->menu )) ? 'checked' : '' }}>
                                            <label for="menu_{{$key}}" class="checkbox_txt"><span>{{$val}}</span></label>
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    </table>

                    <div class="btn-wrap">
                        @if(isset($list))
                            <button type="button" data-name="삭제" class="btn01 btn_cancel">삭제</button>
                        @endif
                        <button type="button" data-name="취소" class="btn01 btn_cancel">취소</button>
                        <button type="button" data-name="{{ isset($list) && $list->id ? '수정' : '등록' }}" class="btn01 btn_submit">{{ isset($list) && $list->id ? '수정' : '등록' }}</button>
                    </div>
                </form>
            </div>

        </article> <!-- article list_head end -->
    </section>

@endsection
