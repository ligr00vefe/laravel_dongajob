@if($id == array_search('채용정보', get_admin_menu_list(), true))
    @forelse($recommend_list as $list)
        <tr>
            <td><input type="checkbox" name="chk[]" class="_chk" value="{{ $list->id }}"></td>
            <td class="visible-pc"> {{ $list->company_name }}</td>
            <td class="visible-pc td_subject">
                <a href="/jobinfo/recommend/{{ $list->id }}/view">{{ $list->recruitment_field }}
            </td>
            <td class="visible-pc">{{ get_recommend_recruitment_lists($list->category) }}</td>
            <td class="visible-pc">{{ get_recommend_screening_method_lists($list->screening_method) }}</td>
            <td class="visible-pc">{{ get_work_area_lists($list->work_area) }}</td>
            <td class="visible-tablet td_summary">
                <p>{{ $list->company_name }}</p>
                <p>{{  $list->recruitment_field }}</p>
                <p class="visible-mobile">{{ $list->created_at }}</p>
            </td>
            <td class="td_deadline invisible-mobile">{{ $list->created_at }}</td>
            <td class="visible-pc">{{  $list->hit }}</td>

    @empty
        <tr>
            <td colspan="8">내역이 존재하지 않습니다.</td>
        </tr>

    @endforelse
@elseif($id == array_search('공지사항', get_admin_menu_list(), true))
    @forelse($notice_lists as $list)
        <tr>
            <td><input type="checkbox" name="chk[]" class="_chk" value="{{ $list->id }}"></td>
            <td class="visible-pc"> {{ $list->id }}</td>
            <td class="visible-pc td_subject">
                <a href="/jobinfo/recommend/{{ $list->id }}/view">{{ $list->subject }}
            </td>
            <td class="visible-pc">관리자</td>
            <td class="visible-tablet td_summary">
                <b>{{ get_notice_category($list->category_id) }}</b>
                <p>{{ $list->subject }}</p>
            </td>
            <td class="td_datetime invisible-mobile">{{ $list->created_at }}</td>
            <td class="visible-pc">{{ $list->hit }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="6">내역이 존재하지 않습니다.</td>
        </tr>

    @endforelse
@endif
