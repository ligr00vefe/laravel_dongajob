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
    @foreach($contents as $content)
        <tr>
            <td>{{ $index++ }}</td>
            <td>{{$content->company_name}}</td>
            <td class="text_left_wrap">{{ $content->recruitment_field }}</td>
            <td>{{ get_recommend_recruitment_lists($content->category) }}</td>
            <td>{{ get_work_area_lists($content->work_area) }}</td>
            <td>{{ get_recommend_screening_method_lists($content->screening_method) }}</td>
            <td>{{ $content->receipt_start_date .' '. $content->receipt_start_time}}</td>
            <td>{{ $content->receipt_end_date .' '. $content->receipt_end_time}}</td>
            <td>
                {{ $content->created_at }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
