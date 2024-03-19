<?php

function get_activity_html($lists)
{
    $html = '';


    foreach ($lists as $list) {
        $html .= ' <li>
                            <a href="/jobinfo/activity/' . $list->id . '/view">
                                <h3 class="m03-subject">' . $list->recruitment_field . '</h3>
                                <span class="deadline-icon di03">마감일</span><p class="deadline-date">' . $list->receipt_end_date . '</p>
                            </a>
                        </li>';
    }


    if (empty($html)) {
        $html = '<div style="text-align: center">등록된 게시물이 없습니다.</div>';
    }

    return $html;
}
