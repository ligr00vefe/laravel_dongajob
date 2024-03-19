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
                {{  $content->created_at }}
            </td>
            <td>{{  $content->company_name }}</td>
            <td>{{ $content->account }}</td>
            <td>{{ $content->name }}</td>
            <td>{{ $content->year }}</td>
            <td>{{ get_gender_list($content->gender)  }}</td>
            <td>{{  $content->department  }}</td>
            <td>{{  $content->grade  }}</td>
            <td>{{  $content->grade_score  }}</td>
            <td>{{  $content->question6 ? get_support_path($content->question6) : ''  }}</td>
            <td>{{  $content->question7 ?? '' }}</td>
            <td>{{  $content->question5? $content->question5 == 100 ? '경험있음' : '경험없음' : ''   }}</td>
            <td>{{  $content->question9 ?? ''  }}</td>
            <td>{{  $content->question1 ?? ''  }}</td>
            <td>{{  $content->question3 ?? ''  }}</td>
            <td>{{  $content->question4 ?? '' }}</td>
            <td>{{  $content->question8 ?? ''  }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
