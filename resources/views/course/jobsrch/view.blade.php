@extends("layouts/layout")

@section("title")

@endsection

@push('scripts')
    <link rel="stylesheet" href="/css/board.css">
@endpush

@php
    $major_menu = "워크넷 직업/진로정보";
    $minor_menu = "직업정보";
@endphp

@section("content")
    <div class="sub-content jobsrch-content">
        <div class="sub-content_title">
            <h1>{{ $post->jobSmclNm }}</h1>
        </div>

        <div class="jobsrch-view-nav">
           <p>
               <span>{{ $post->jobLrclNm }}</span>
               <span class="nav-arrow">&gt;</span>
               <span>{{ $post->jobMdclNm }}</span>
               <span class="nav-arrow">&gt;</span>
               <span>{{ $post->jobSmclNm }}</span>
           </p>
        </div>

        <div class="board-wrap board-view jobsrch-view">
            <div class="view-wrap">
                <div class="view-content">
                   <table>
                       <tbody>
                           <tr>
                               <th><img src="/img/hard-work.png" alt="직업정보 목록 아이콘1"></th>
                               <td>
                                   <h1 class="li-tit">하는 일</h1>
                                   <p>
                                       {{ $post->jobSum ?: '-' }}
                                   </p>
                               </td>
                           </tr>
                           <tr>
                               <th><img src="/img/knowledge.png" alt="직업정보 목록 아이콘2"></th>
                               <td>
                                   <h1 class="li-tit">필수 기술 및 지식</h1>
                                   <p>
                                       {{ $post->way ?: '-' }}
                                   </p>
                               </td>
                           </tr>
                           <tr>
                               <th><img src="/img/piggy-bank.png" alt="직업정보 목록 아이콘3"></th>
                               <td>
                                   <h1 class="li-tit">임금</h1>
                                   <p>
                                       {{ $post->sal ?: '-' }}
                                   </p>
                               </td>
                           </tr>
                           <tr>
                               <th><img src="/img/motivation.png" alt="직업정보 목록 아이콘4"></th>
                               <td>
                                   <h1 class="li-tit">일자리 전망</h1>
                                   <p>
                                       {{ $post->jobProspect ?: '-' }}
                                   </p>
                               </td>
                           </tr>
                           <tr>
                               <th><img src="/img/acknowledgement.png" alt="직업정보 목록 아이콘5"></th>
                               <td>
                                   <h1 class="li-tit">직업만족도</h1>
                                   <p>
                                       {{ $post->jobSatis ?: '-' }}
                                   </p>
                               </td>
                           </tr>
                       </tbody>
                   </table>
                </div>
                <div class="view-bottom">
                    <div class="btn-wrap">
                        <div class="btn-right">
                            <a href="/course/jobsrch?page={{ isset($page)  ? $page : 1 }}" class="btn-list btn01">목록</a>
                        </div>
                    </div>
                </div>{{-- //.view-bottom end --}}
            </div>{{-- //.view-wrap end --}}
        </div>{{-- //.board-wrap end --}}
    </div>{{-- //.sub-content.jobsrch-content end --}}

@endsection
