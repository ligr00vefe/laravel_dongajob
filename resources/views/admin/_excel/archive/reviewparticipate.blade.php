@php
    use App\Models\Student;
    use App\Models\User;
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

        @php
            $name = '-';
            $dpt = '-';
            if (isStudentCheck($content->user_type)) {
                    if($student = Student::getStudent($content->account)) {
                     $name = $student->name;
                     $dpt = $student->department;
                }
              } else if (isAdminCheck($content->user_type)) {
                  $name = User::getUser($content->account)->name;
                  $dpt = '-';
              }
        @endphp

        <tr>
            <td>
                {{ $index++ }}
            </td>
            <td>
                {{ $content->account }}
            </td>
            <td>
                {{ $name }}
            </td>
            <td>
                {{ $dpt }}
            </td>
            <td>
                {{ $content->subject }}
            </td>
            <td>-</td>
            <td>
                {{ $content->created_at }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

