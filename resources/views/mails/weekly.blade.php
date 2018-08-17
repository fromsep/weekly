<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{$startDate}} - {{$endDate}} 周报邮件</title>
</head>
<body>
    <div>
        <table border="1" cellspacing="0">
            <tr bgcolor="#6495ed">
                <td>&nbsp;&nbsp;项目组&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;姓名&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;项目&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;进度&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;完成百分比&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;评审日期&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;开发日期&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;提测日期&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;上线日期&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;备注&nbsp;&nbsp;</td>
            </tr>

            @foreach($groups as $group)
            {{--组--}}
            <tr bgcolor="#ff8c00">
                <td>&nbsp;&nbsp;{{$group['group_name']}}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            @foreach($group['users'] as $user)
            {{--人--}}
            <tr bgcolor="#adff2f">
                <td></td>
                <td>&nbsp;&nbsp;{{$user['user_name']}}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

                @foreach($user['list'] as $value)
            {{--工作--}}
            <tr>
                <td></td>
                <td></td>
                <td>{{$value['title']}}</td>
                <td>{{$value['schedule']}}</td>
                <td>&nbsp;&nbsp;{{$value['completion_rate']}}%</td>
                <td>{{$value['review_date']}}</td>
                <td>{{$value['development_date']}}</td>
                <td>{{$value['testing_date']}}</td>
                <td>{{$value['launch_date']}}</td>
                <td>{{$value['remarks']}}</td>
            </tr>
            @endforeach
            @endforeach
            @endforeach
        </table>
    </div>
</body>
</html>