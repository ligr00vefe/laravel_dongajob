@php
    use App\Models\Student;
@endphp

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
            <td>
                {{ Student::getStudent($content->user_id) ? Student::getStudent($content->user_id)->name : '-'  }}
            </td>
            <td>{{ $content->user_id }}</td>
            <td>{{$content->enterprise}}</td>
            <td>{{ get_interview_category($content->category) }}</td>
            <td>{{ ($content->support_division) }}</td>
            <td>
                @if($content->status == 100)
                    미입력
                @elseif($content->status == 200)
                    합격
                @elseif($content->status == 300)
                    불합격
                @else
                    {{ $content->status }}
                @endif
            </td>
            <td>
                {{ $content->created_at }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
