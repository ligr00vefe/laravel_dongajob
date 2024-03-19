@extends("layouts/layout")

@section("title")
    비밀번호 확인
@endsection

@push('scripts')
@endpush

@section("content")
    <div class="confirm-content">
        <p>회원 비밀번호 확인</p>

        <div class="content-guide">
            <p>비밀번호를 한번 더 입력해주세요.</p>
            <p>회원님의 정보를 안전하게 보호하기 위해 비밀번호를 한번 더 확인합니다.</p>
        </div>

        <div class="confirm-info">
            <div>회원아이디</div>
            <span>test100</span>
            <input type="text" class="frm_input" placeholder="비밀번호">
        </div>

        <div class="confirm-box">
            <button type="button" class="" onclick="location.href='/'">취소</button>
            <button type="button" onclick="location.href='/user/modify'">확인</button>
        </div>
    </div>
@endsection
