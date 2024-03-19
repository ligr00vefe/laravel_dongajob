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
                {{ get_campus_name($content->campus_id) }}
            </td>
            <td>
                {{ $content->name }}
            </td>
            <td>
                {{ $content->info_desc }}
            </td>
            <td>
                {{ $content->location }}
            </td>
            <td>
                {{ $content->time }}
            </td>
            <td>
                {{ show_use_data($content->use) }}
            </td>
            <td>
                {{ $content->max_personnel }}
            </td>
            <td>
                {{ $content->min_personnel }}
            </td>
            <td>
                {{ $content->office_equipment }}
            </td>
            <td>
                {{ $content->room_ip }}
            </td>
            <td>
                {{ $content->created_at }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
