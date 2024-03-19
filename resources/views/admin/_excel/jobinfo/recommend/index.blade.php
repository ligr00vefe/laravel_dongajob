<table>
    <thead>
    <tr style="height: 50px; vertical-align: top;">
        @foreach ($heads as $head)
            <th align="center"
                style="background-color: #778beb; color: #ffffff; padding: 15px 0; font-weight: bold; height: 30px; text-align: center; vertical-align: center; font-size: 14px;">{{ $head }}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach($contents as $list)
        <tr>
            <td>
                {{ $index++ }}
            </td>
            <td>
                {{$list->company_name ?: '-'}}
            </td>
            <td>
                {{ $list->recruitment_field ?: '-'}}
            </td>
            <td>
                {{get_recommend_recruitment_lists($list->category) }}
            </td>
            <td>
                {{ get_work_area_lists($list->work_area) }}
            </td>
            <td>
                {{ get_recommend_screening_method_lists($list->screening_method) }}
            </td>
            <td>
                {{ $list->receipt_start_date .' '. $list->receipt_start_time}}
            </td>
            <td>{{ $list->receipt_end_date .' '. $list->receipt_end_time}}</td>
            <td>
                {{ $list->created_at }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
