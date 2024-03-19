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
            <td>
                {{ $index++ }}
            </td>
            <td>{{ $content->company_name ?? "" }}</td>
            <td>{{ $content->recruitment_field ?? ""}}</td>
            <td>{{ get_work_area_lists($content->work_area ?? "") }}</td>
            <td>{{ get_activity_gender_lists($content->gender_field) . '/' . $content->age_field ?: "-"}}</td>
            <td>{{ $content->receipt_end_date ?? "" .' '. $content->receipt_end_time ?? "" }}</td>
            <td>
                {{ $content->created_at }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
