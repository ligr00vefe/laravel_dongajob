@extends("layouts/layout")

@section("title")
    동아대 취업지원실 - 구성원 소개
@endsection

@push('scripts')
    <link rel="stylesheet" href="/css/introduce.css">
@endpush

@php
    $major_menu = "취업지원실";
    $minor_menu = "구성원소개";
@endphp

@section("content")
    <div class="sub-content">
        <div class="sub-content_title">
            <h1>구성원 소개</h1>
        </div>

        <div class="sub_topbanner_wrap">
            <div class="top_pc" >
                <h2>동아대학교 취업지원실이 학생 여러분과 함께합니다</h2>
                <p>열린 미래의 꿈이 있는 대학, 졸업 후 더욱 빛을 발하는 대학</p>
                <p>동아대학교 취업지원실이 다양한 프로그램과 지원사업으로 힘이 되어 드립니다.</p>
            </div>
            <div class="top_tab">
                <h2>동아대학교 취업지원실이 학생 여러분과 함께합니다</h2>
                <p>열린 미래의 꿈이 있는 대학, 졸업 후 더욱 빛을 발하는 대학</p>
                <p>동아대학교 취업지원실이 다양한 프로그램과 지원사업으로 힘이 되어 드립니다.</p>
            </div>
            <div class="top_m">
                <h2>동아대학교 취업지원실이 학생 여러분과 함께합니다</h2>
                <p>열린 미래의 꿈이 있는 대학, 졸업 후 더욱 빛을 발하는 대학</p>
                <p>동아대학교 취업지원실이 다양한 프로그램과 지원사업으로 힘이 되어 드립니다.</p>
            </div>
        </div>

        <div class="sub_container_wrap">
            <div class="bullet_content_wrap">
                <div class="bullet_title">조직도</div>
            </div>
            <div class="pdt30 content_imgwrap">
                <img class="top_pc" src="/img/organization.png" alt="조직도" style="max-width:1200px; ">
                <img class="top_tab" src="/img/organization_t.png" alt="조직도">
                <img class="top_m" src="/img/organization_m.png" alt="조직도">
            </div>

        </div>

        <div class="sub_container_wrap pdt50">
            <div class="bullet_content_wrap">
                <div class="bullet_title">구성원 소개</div>
            </div>

            <!--------- 표시작 ----------->
            <div class="content_tablewrap pdt30">
                <table class="top_gray_table">

                    <tr>
                        <th class="tb_section01">직위</th>
                        <th class="tb_section02">성명</th>
                        <th class="tb_section03">업무내용</th>
                        <th class="tb_section04">이메일</th>
                    </tr>

                    <tr>
                        <td class="txtcenter">실장</td>
                        <td class="txtcenter">이인용</td>
                        <td>
                            취업지원실 업무 총괄 및 계획 수립<br />
                            글로벌 인재개발센터 업무 총괄 <br />
                            대학일자리플러스센터 업무 총괄 <br />
                            각종 위원회 운영 <br />
                            기업 방문 운영, 학과특강 운영
                        </td>
                        <td class="txtcenter">brian3@dau.ac.kr</td>
                    </tr>

                    <tr>
                        <td class="txtcenter">팀원</td>
                        <td class="txtcenter">김지현</td>
                        <td>
                            취업동아리 운영 및 기업방문<br />
                            대학혁신지원사업, LINC+사업 계획 및 운영<br />
                            영호남 4개 대학 협의회<br />
                            예산 계획 수립 및 운영
                        </td>
                        <td class="txtcenter">hyeon0520@dau.ac.kr</td>
                    </tr>

                    <tr>
                        <td class="txtcenter">팀원</td>
                        <td class="txtcenter">류단비</td>
                        <td>
                            취업동아리 운영 및 취업상담 <br />
                            부산시 사업 계획 및 운영 <br />
                            직장체험 프로그램 운영 <br />
                            여대생 교육 운영(항만물류)
                        </td>
                        <td class="txtcenter">dbryu@dau.ac.kr</td>
                    </tr>

                    <tr>
                        <td class="txtcenter">팀원</td>
                        <td class="txtcenter">이경훈</td>
                        <td>
                            취업동아리 운영 및 취업추천 <br />
                            대학일자리플러스센터 운영 <br />
                            학사조교 인력풀 관리
                        </td>
                        <td class="txtcenter">lkh5566@dau.ac.kr</td>
                    </tr>

                    <tr>
                        <td class="txtcenter">팀원</td>
                        <td class="txtcenter">황재윤</td>
                        <td>
                            취업동아리 운영 및 취업상담 <br />
                            동계,하계 실무자/자격증 과정 운영 <br />
                            취업교육기금 및 기념품 관리 <br />
                            취업자료실 및 근로 관리
                        </td>
                        <td class="txtcenter">jyhwang@dau.ac.kr</td>
                    </tr>

                    <tr>
                        <td class="txtcenter">팀원</td>
                        <td class="txtcenter">이석용</td>
                        <td>
                            취업동아리 운영 및 취업상담 <br />
                            취업통계 및 교수업적평가 운영 <br />
                            취업지도교수, 산학협력교수 운영 <br />
                            기업방문
                        </td>
                        <td class="txtcenter">lsy7007@dau.ac.kr</td>
                    </tr>

                    <tr>
                        <td class="txtcenter">팀원</td>
                        <td class="txtcenter">최준환</td>
                        <td>
                            취업동아리 운영 및 취업상담 <br />
                            채용설명회 운영 <br />
                            자동차, 반도체 실무자 양성과정 운영
                        </td>
                        <td class="txtcenter">tcj1790@dau.ac.kr</td>
                    </tr>

                    <tr>
                        <td class="txtcenter">팀원</td>
                        <td class="txtcenter">김근민</td>
                        <td>
                            취업동아리 운영 및 취업상담 <br />
                            취업지원실 홈페이지, SPEC UP 시스템 운영 <br />
                            설비기술, 조선해양플랜트 실무자 양성과정 운영 <br />
                            기사단기스터디 운영
                        </td>
                        <td class="txtcenter">tcj1790@dau.ac.kr</td>
                    </tr>

                    <tr>
                        <td class="txtcenter">팀원</td>
                        <td class="txtcenter">이보람</td>
                        <td>
                            취업동아리 및 선배초청 교육 운영 <br />
                            다잇다 시스템 관리 운영 <br />
                            장기현장실습 운영
                        </td>
                        <td class="txtcenter">bborang2@dau.ac.kr</td>
                    </tr>

                    <tr>
                        <td class="txtcenter">팀원</td>
                        <td class="txtcenter">이태광</td>
                        <td>
                            취업동아리 운영 <br />
                            단대 취업지원사업 운영 <br />
                            영단기/공단기 운영 <br />
                            취업책자 및 브로슈어 제작
                        </td>
                        <td class="txtcenter">runtime96@dau.ac.kr</td>
                    </tr>

                    <tr>
                        <td class="txtcenter">팀원</td>
                        <td class="txtcenter">김민수</td>
                        <td>
                            승학 해외취업 프로그램 운영
                        </td>
                        <td class="txtcenter">kimminsoo@dau.ac.kr</td>
                    </tr>

                    <tr>
                        <td class="txtcenter">팀원</td>
                        <td class="txtcenter">박신영</td>
                        <td>
                            부민 해외취업 프로그램 운영
                        </td>
                        <td class="txtcenter">synnp@dau.ac.kr</td>
                    </tr>

                    <tr>
                        <td class="txtcenter">팀원</td>
                        <td class="txtcenter">정예린</td>
                        <td>
                            경영대학 상담 및 프로그램 운영 <br />
                            워크넷 채용정보 홍보 및 일자리 매칭 <br />
                            일자리플러스센터, 취업캠프 운영 지원
                        </td>
                        <td class="txtcenter">yerin@dau.ac.kr</td>
                    </tr>

                    <tr>
                        <td class="txtcenter">팀원</td>
                        <td class="txtcenter">이아람</td>
                        <td>
                            사회/국제/석당/중일 상담 및 프로그램 운영 <br />
                            취업교과목 운영 <br />
                            일자리플러스센터, 취업캠프 운영지원
                        </td>
                        <td class="txtcenter">215130@dau.ac.kr</td>
                    </tr>

                    <tr>
                        <td class="txtcenter">조교수(연구)</td>
                        <td class="txtcenter">방희원</td>
                        <td>
                            대학일자리플러스센터 진로 업무 수행
                        </td>
                        <td class="txtcenter">huiwon@dau.ac.kr</td>
                    </tr>

                    <tr>
                        <td class="txtcenter">팀원</td>
                        <td class="txtcenter">김민애</td>
                        <td>
                            대학일자리플러스센터 진로 업무 수행
                        </td>
                        <td class="txtcenter">alsdo0933@dau.ac.kr</td>
                    </tr>

                    <tr>
                        <td class="txtcenter">팀원</td>
                        <td class="txtcenter">제소정</td>
                        <td>
                            부민 스터디룸, 취업자료실 및 근로학생 관리 <br />
                            부민 교육 및 행사, 특강 지원
                        </td>
                        <td class="txtcenter">jesojeong@dau.ac.kr</td>
                    </tr>

                    <tr>
                        <td class="txtcenter">팀원</td>
                        <td class="txtcenter">조슬기</td>
                        <td>
                            승학 교육 및 자료 정리 지원 <br />
                            승학 학과특강 지원 및 설문 통계
                        </td>
                        <td class="txtcenter">o0o405@dau.ac.kr</td>
                    </tr>

                    <tr>
                        <td class="txtcenter">팀원</td>
                        <td class="txtcenter">엄예연</td>
                        <td>
                            취업추천 지원 <br />
                            승학 스터디룸 교육시설 대여 및 관리
                        </td>
                        <td class="txtcenter">dja9797@dau.ac.kr</td>
                    </tr>

                </table>
            </div>
            <!--------- 표 끝 ----------->



            <!--------- 모바일 표시작 ----------->
            <div class="content_tablewrap ">
                <table class="top_gray_table_m">

                    <tr>
                        <th class="tb_section01">
                            <span class="bluetxt">실장</span>
                            <br />
                            이인용
                        </th>
                        <td class="tb_section02">
                            취업지원실 업무 총괄 및 계획 수립<br />
                            글로벌 인재개발센터 업무 총괄<br />
                            대학일자리플러스센터 업무 총괄<br />
                            각종 위원회 운영<br />
                            기업 방문 운영, 학과특강 운영
                            <br /><br />
                            <b>brian3@dau.ac.kr</b>
                        </td>
                    </tr>

                    <tr>
                        <th class="tb_section01">
                            <span class="bluetxt">팀원</span>
                            <br />
                            김지현
                        </th>
                        <td class="tb_section02">
                            취업동아리 운영 및 기업방문 <br />
                            대학혁신지원사업, LINC+사업 계획 및 운영 <br />
                            영호남 4개 대학 협의회 <br />
                            예산 계획 수립 및 운영
                            <br /><br />
                            <b>hyeon0520@dau.ac.kr</b>
                        </td>
                    </tr>

                    <tr>
                        <th class="tb_section01">
                            <span class="bluetxt">팀원</span>
                            <br />
                            류단비
                        </th>
                        <td class="tb_section02">
                            취업동아리 운영 및 취업상담<br />
                            부산시 사업 계획 및 운영<br />
                            직장체험 프로그램 운영<br />
                            여대생 교육 운영(항만물류)
                            <br /><br />
                            <b>dbryu@dau.ac.kr</b>
                        </td>
                    </tr>

                    <tr>
                        <th class="tb_section01">
                            <span class="bluetxt">팀원</span>
                            <br />
                            이경훈
                        </th>
                        <td class="tb_section02">
                            취업동아리 운영 및 취업추천<br />
                            대학일자리플러스센터 운영<br />
                            학사조교 인력풀 관리
                            <br /><br />
                            <b>lkh5566@dau.ac.kr</b>
                        </td>
                    </tr>

                    <tr>
                        <th class="tb_section01">
                            <span class="bluetxt">팀원</span>
                            <br />
                            황재윤
                        </th>
                        <td class="tb_section02">
                            취업동아리 운영 및 취업상담<br />
                            동계,하계 실무자/자격증 과정 운영<br />
                            취업교육기금 및 기념품 관리<br />
                            취업자료실 및 근로 관리
                            <br /><br />
                            <b>jyhwang@dau.ac.kr</b>
                        </td>
                    </tr>

                    <tr>
                        <th class="tb_section01">
                            <span class="bluetxt">팀원</span>
                            <br />
                            이석용
                        </th>
                        <td class="tb_section02">
                            취업동아리 운영 및 취업상담<br />
                            취업통계 및 교수업적평가 운영<br />
                            취업지도교수, 산학협력교수 운영<br />
                            기업방문
                            <br /><br />
                            <b>lsy7007@dau.ac.kr</b>
                        </td>
                    </tr>

                    <tr>
                        <th class="tb_section01">
                            <span class="bluetxt">팀원</span>
                            <br />
                            최준환
                        </th>
                        <td class="tb_section02">
                            취업동아리 운영 및 취업상담<br />
                            채용설명회 운영<br />
                            자동차, 반도체 실무자 양성과정 운영
                            <br /><br />
                            <b>tcj1790@dau.ac.kr</b>
                        </td>
                    </tr>

                    <tr>
                        <th class="tb_section01">
                            <span class="bluetxt">팀원</span>
                            <br />
                            김근민
                        </th>
                        <td class="tb_section02">
                            취업동아리 운영 및 취업상담<br />
                            취업지원실 홈페이지, SPEC UP 시스템 운영<br />
                            설비기술, 조선해양플랜트 실무자 양성과정 운영<br />
                            기사단기스터디 운영
                            <br /><br />
                            <b>tcj1790@dau.ac.kr</b>
                        </td>
                    </tr>

                    <tr>
                        <th class="tb_section01">
                            <span class="bluetxt">팀원</span>
                            <br />
                            이보람
                        </th>
                        <td class="tb_section02">
                            취업동아리 및 선배초청 교육 운영<br />
                            다잇다 시스템 관리 운영<br />
                            장기현장실습 운영
                            <br /><br />
                            <b>bborang2@dau.ac.kr</b>
                        </td>
                    </tr>

                    <tr>
                        <th class="tb_section01">
                            <span class="bluetxt">팀원</span>
                            <br />
                            이태광
                        </th>
                        <td class="tb_section02">
                            취업동아리 운영 <br />
                            단대 취업지원사업 운영 <br />
                            영단기/공단기 운영 <br />
                            취업책자 및 브로슈어 제작
                            <br /><br />
                            <b>runtime96@dau.ac.kr</b>
                        </td>
                    </tr>

                    <tr>
                        <th class="tb_section01">
                            <span class="bluetxt">팀원</span>
                            <br />
                            김민수
                        </th>
                        <td class="tb_section02">
                            승학 해외취업 프로그램 운영
                            <br /><br />
                            <b>kimminsoo@dau.ac.kr</b>
                        </td>
                    </tr>

                    <tr>
                        <th class="tb_section01">
                            <span class="bluetxt">팀원</span>
                            <br />
                            박신영
                        </th>
                        <td class="tb_section02">
                            부민 해외취업 프로그램 운영
                            <br /><br />
                            <b>synnp@dau.ac.kr</b>
                        </td>
                    </tr>

                    <tr>
                        <th class="tb_section01">
                            <span class="bluetxt">팀원</span>
                            <br />
                            정예린
                        </th>
                        <td class="tb_section02">
                            경영대학 상담 및 프로그램 운영<br />
                            워크넷 채용정보 홍보 및 일자리 매칭<br />
                            일자리플러스센터, 취업캠프 운영 지원
                            <br /><br />
                            <b>yerin@dau.ac.kr</b>
                        </td>
                    </tr>

                    <tr>
                        <th class="tb_section01">
                            <span class="bluetxt">팀원</span>
                            <br />
                            이아람
                        </th>
                        <td class="tb_section02">
                            사회/국제/석당/중일 상담 및 프로그램 운영<br />
                            취업교과목 운영<br />
                            일자리플러스센터, 취업캠프 운영지원
                            <br /><br />
                            <b>215130@dau.ac.kr</b>
                        </td>
                    </tr>

                    <tr>
                        <th class="tb_section01">
                            <span class="bluetxt">조교수(연구)</span>
                            <br />
                            방희원
                        </th>
                        <td class="tb_section02">
                            대학일자리플러스센터 진로 업무 수행
                            <br /><br />
                            <b>huiwon@dau.ac.kr</b>
                        </td>
                    </tr>

                    <tr>
                        <th class="tb_section01">
                            <span class="bluetxt">팀원</span>
                            <br />
                            김민애
                        </th>
                        <td class="tb_section02">
                            대학일자리플러스센터 진로 업무 수행
                            <br /><br />
                            <b>alsdo0933@dau.ac.kr</b>
                        </td>
                    </tr>

                    <tr>
                        <th class="tb_section01">
                            <span class="bluetxt">팀원</span>
                            <br />
                            제소정
                        </th>
                        <td class="tb_section02">
                            부민 스터디룸, 취업자료실 및 근로학생 관리 <br />
                            부민 교육 및 행사, 특강 지원
                            <br /><br />
                            <b>jesojeong@dau.ac.kr</b>
                        </td>
                    </tr>

                    <tr>
                        <th class="tb_section01">
                            <span class="bluetxt">팀원</span>
                            <br />
                            조슬기
                        </th>
                        <td class="tb_section02">
                            승학 교육 및 자료 정리 지원<br />
                            승학 학과특강 지원 및 설문 통계
                            <br /><br />
                            <b>o0o405@dau.ac.kr</b>
                        </td>
                    </tr>

                    <tr>
                        <th class="tb_section01">
                            <span class="bluetxt">팀원</span>
                            <br />
                            엄예연
                        </th>
                        <td class="tb_section02">
                            취업추천 지원<br />
                            승학 스터디룸 교육시설 대여 및 관리
                            <br /><br />
                            <b>dja9797@dau.ac.kr</b>
                        </td>
                    </tr>

                </table>
            </div>
            <!--------- 모바일 표 끝 ----------->

        </div>
    </div>


@endsection
