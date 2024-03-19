@extends("layouts.layout")

@section("title")
    동아대 취업지원실 프로그램 - 서류합격자 면접교육 접수
@endsection

@php
    $major_menu = "취업지원실 프로그램";
    $minor_menu = "서류합격자 면접교육 접수";
@endphp

@push('scripts')
    <script src="/lib/ckeditor5/build/ckeditor.js"></script>
    <script src="/js/UploadAdaptor.js"></script>
    <script defer src="/js/program/interview/create.js"></script>
    <link rel="stylesheet" href="/css/board.css">
    <script defer src="/js/archive.js"></script>
@endpush

@php
    use Illuminate\Support\Facades\Auth;
    $category_list = get_interview_category();
    $next_list = get_interview_next_type();
@endphp


@if(!session()->get('login_check'))
    <script>
        alert("로그인이 필요한 서비스입니다.");
        location.href = '/login';
    </script>
@endif

@section("content")
    <div class="sub-content">
        <div class="sub-content_title">
            <h1>서류합격자 면접교육 접수</h1>
        </div>

        <div class="board-wrap board-create">
            <form action="{{ route('program.interview.write') }}" method="post" name="forms" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{ session()->get('login_check') ? session()->get('account') : '' }}">
                <div class="table02-create table02 table-interview create-interview first-table">
                    <div class="table-title">
                        <h1>신청정보</h1>
                    </div>

                    <table>
                        <tbody>
                        <tr>
                            <th class="w167">이름</th>
                            <td>
                                <p>{{ session()->get('login_check') ? sprintf('%s(%s:%s)', session()->get('name'), session()->get('account'), session()->get('department') ?? "" ) : '' }}</p>
                            </td>
                        </tr>
                        <tr>
                            <th class="w167">전화번호</th>
                            <td>
                                <p>{{ session()->get('login_check') ? session()->get('phone_number') : '' }}</p>
                                <small>* 전화번호가 잘못된 경우에는 학적정보에서 수정바랍니다.</small>
                            </td>
                        </tr>
                        <tr>
                            <th class="w167">지원기업</th>
                            <td>
                                <input type="text" name="enterprise" class="tbl-input w683">
                                <small>다수의 기업에 합격한 경우 기업별 각 1회씩 신청바랍니다. ex) 3개의 기업에 합격한 경우 3회신청</small>
                            </td>
                        </tr>
                        <tr>
                            <th class="w167">지원구분</th>
                            <td>
                                @foreach($category_list as $key => $value)
                                    <input type="radio" id="interview_category_{{ $key }}" class="tbl-radio" value="{{ $key }}" name="category">
                                    <label for="interview_category_{{ $key }}" class="radio_button_txt">{{ $value }}</label>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th class="w167">지원사업부</th>
                            <td>
                                <input type="text" name="support_division" class="tbl-input w683">
                            </td>
                        </tr>
                        <tr>
                            <th class="w167">지원직무</th>
                            <td>
                                <input type="text" name="support_job" class="tbl-input w683">
                            </td>
                        </tr>
                        <tr>
                            <th class="w167">다음 전형</th>
                            <td>
                                @foreach($next_list as $key => $value)
                                    <input type="radio" id="interview_next_{{ $key }}" class="tbl-radio" value="{{ $key }}" name="next_round">
                                    <label for="interview_next_{{ $key }}" class="radio_button_txt"><sapn>{{ $value }}</sapn></label>
                                @endforeach

                            </td>
                        </tr>
                        <tr>
                            <th class="w167">다음 전형 일정 <span class="required_star">*</span></th>
                            <td>
                                <input type="date" name="next_round_schedule" class="tbl-input w683">
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2" class="editor-wrap">
                                @include("_include.editor.ckeditor5", [
                                  "editor_name" => "contents",
                                  "comment" => false,
                                  "image" => true,
                                  "path" => "interview",
                                  "contents" => ""
                              ])
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="table02-create table02 receipt-agree">
                    <div class="table-title">
                        <h1>개인정보 수집 및 이용동의</h1>
                    </div>

                    <table>
                        <colgroup>
                            <col width="100%">
                        </colgroup>
                        <tbody>
                        <tr>
                            <th class="text-subject">개인정보 수집·이용·제공 동의서</th>
                        </tr>
                        <tr>
                            <td>
                                <span class="text-content">
                                    <p>
                                       1. 개인정보의 수집·이용 목적 : 서류합격자 면접교육 관련 개별 연락 및 확인, 통계자료 활용 <br/>
                                        2. 수집하려는 개인정보의 항목 : 성명, 대학/학부(과), 학번, 연락처 <br/>
                                        3. 개인정보의 보유 및 이용 기간 : 5년 <br/>
                                        4. 동의를 거부할 권리 및 거부에 따른 불이익 : 개인정보 수집·이용을 거부할 수 있으며, 동의를 거부할 경우 서비스이용이 불가함
                                    </p>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="radio" name="agree01" id="agree01-01" class="input-checkCircle">
                                <label for="agree01-01">상기인은 개인정보수집동의서에 동의합니다.</label>
                                <input type="radio" name="agree01" id="agree01-02" class="input-checkCircle">
                                <label for="agree01-02">동의하지 않습니다.</label>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-subject">개인정보 제3자 제공 동의</th>
                        </tr>
                        <tr>
                            <td>
                                <span class="text-content">
                                    <p>
                                        1. 개인정보를 제공받는자: 귀하가 신청한 추천전형의 외부 기관 <br/>
                                        2. 개인정보를 제공받는자의 이용목적: 평가를 통한 채용 <br/>
                                        3. 개인정보를 제공하는 항목: 성명, 대학/학부(과), 학번, 재학여부, 성별, 학년, 연락처 <br/>
                                        4. 개인정보를 제공받는자의 보유 및 이용기간: 채용 종료시까지<br/>
                                        5. 동의를 거부할 권리 및 거부에 따른 불이익: 개인정보 수집 이용을 거부할 수 있으며, 동의를 거부할 경우 상담접수가 불가능함
                                    </p>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="radio" name="agree02" id="agree02-01" class="input-checkCircle">
                                <label for="agree02-01">상기인은 개인정보수집동의서에 동의합니다.</label>
                                <input type="radio" name="agree02" id="agree02-02" class="input-checkCircle">
                                <label for="agree02-02">동의하지 않습니다.</label>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>{{-- //.table-create.table02 end --}}

                <div class="btn-wrap create-btn">
                    <a href="/program/interview" class="btn-cancel btn02">취소</a>
                    <button type="button" class="btn-save btn02">저장</button>
                </div>
            </form>
        </div>{{-- //.board-wrap end --}}
    </div>{{-- //.sub-content end --}}

@endsection
