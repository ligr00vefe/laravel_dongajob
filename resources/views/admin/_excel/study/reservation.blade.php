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
            <td>
                {{ $content->account }}
            </td>
            <td>
                {{ get_study_room_reservation_type($content->type) }}
            </td>
            <td>
                {{ \App\Models\StudyRoom::find($content->room_id)->name }}
            </td>
            <td>
                {{ get_campus_name($content->campus_id) }}
            </td>
            <td>
                {{ get_room_target_type($content->target_type) }}
            </td>
            <td>
                {{ $content->use_people }}
            </td>
            <td>
                {{ $content->office_equipment }}
            </td>
            <td>
                {{ $content->location }}
            </td>
            <td>
                {{ get_room_status($content->status) }}
            </td>
            <td>
                {{ $content->date }}
            </td>
            <td>
                {{ $content->time }}
            </td>
            <td>
                {{ $content->ip }}
            </td>
            <td>
                {{ $content->created_at }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

