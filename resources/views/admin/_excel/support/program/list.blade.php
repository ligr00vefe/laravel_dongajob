<table>
    <thead>
    <tr style="height: 50px; vertical-align: top;">
        @foreach ($heads as $head)
            <th align="center" style="background-color: #778beb; color: #ffffff; padding: 15px 0; font-weight: bold; height: 30px; text-align: center; vertical-align: center; font-size: 14px;">{{ $head }}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach($applicant_lists as $applicant_list)
        <tr>
            <td>   {{ ($applicant_lists->total()-$loop->index)-(($applicant_lists->currentpage()-1) * $applicant_lists->perpage() ) }}</td>
            <td>{{ $contents->subject }}</td>
            <td>{{ $applicant_list->created_at }}</td>
            <td>{{ $applicant_list->name }}</td>
            <td>{{ get_gender_list($applicant_list->gender) }}</td>
            <td>{{ $applicant_list->phone_number }}</td>
            <td>{{ $applicant_list->account }}</td>
            <td>{{ $applicant_list->line }}</td>
            <td>{{ $applicant_list->department }}</td>
            <td>{{ $applicant_list->grade }}</td>
            <td>{{ $applicant_list->academic }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
