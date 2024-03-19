<table>
    <thead>
    <tr style="height: 50px; vertical-align: top;">
        @foreach ($heads as $head)
            <th align="center" style="background-color: #778beb; color: #ffffff; padding: 15px 0; font-weight: bold; height: 30px; text-align: center; vertical-align: center; font-size: 14px;">{{ $head }}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach($contents as $content)
        <tr>
            <td>
                {{ $index++ }}
            </td>
            <td>{{$content->subject}}</td>
            <td>{{ $content->location }}</td>
            <td>{{ $content->number_students }}명</td>
            <td>{{date("y-m-d", strtotime($content->start_course_date)) .' ~ '. date("y-m-d", strtotime($content->end_course_date))}}</td>
            <td>{{date("y-m-d", strtotime($content->start_reception_date)) .' ~ '. date("y-m-d", strtotime($content->end_reception_date))}}</td>
            <td>
                {{ get_program_open_lists($content->open) }}
            </td>
            <td>{{ get_program_status_lists($content->status) }}</td>
            <td>
                {{ $content->created_at }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
