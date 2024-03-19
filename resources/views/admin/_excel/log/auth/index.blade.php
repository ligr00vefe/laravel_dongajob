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
        @php

            $before_menu = '-';
            $after_menu = '-';


          if(isLogAuthority($content->action)) {



              if($content->keyword) {
                  $menu = explode('/', $content->keyword);


                  $before_menu = [];
                  foreach (explode(',', $menu[0]) as $val) {
                      $before_menu[] = get_admin_menu_list($val);
                  }

                  $after_menu = [];
                  foreach (explode(',', $menu[1]) as $val) {
                      $after_menu[] = get_admin_menu_list($val);
                  }

                 $before_menu = implode(',', $before_menu);
                 $after_menu = implode(',', $after_menu);
              } else {
                  $content->keyword = '';
              }
              var_dump($content->keyword);
          }

        @endphp

        <tr>
            <td>
                {{ $index++ }}
            </td>
            <td>
                {{ $content->action }}
            </td>
            <td>
                {{ \App\Models\User::find($content->user_id)->account.'(' .\App\Models\User::find($content->user_id)->name.')' }}
            </td>
            <td>
                {{--1{{  App\Models\User::getExists($content->target) ? $content->target .'(' . App\Models\User::getUser($content->target)->name .')' : $content->target .'(-)' }}--}}
                {{ $content->keyword ?: '-' }}
            </td>
            <td>
                {{ $before_menu }}
            </td>
            <td>
                {{ $after_menu }}
            </td>
            <td>
                {{ $content->comment ?: '-'}}
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
