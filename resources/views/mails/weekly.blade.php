<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{$startDate}} - {{$endDate}} 周报邮件</title>
</head>
<body>
    <div>

    @foreach($groups as $key => $group)
    <div>
        <h2>[{{$group['group_name']}}]</h2>
    </div>
    <table border="1" cellspacing="0">
            @foreach($group['users'] as $user)
            {{--人--}}
            <tr bgcolor="#6495ed">
                <td>&nbsp;&nbsp;项目&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;进度&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;完成百分比&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;评审日期&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;开发日期&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;提测日期&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;上线日期&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;开发测试人员&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;备注&nbsp;&nbsp;</td>
            </tr>
            @foreach($user['list'] as $value)
            {{--工作--}}
            <tr>
                <td>{{$value['title']}}</td>
                <td>{{$value['schedule']}}</td>
                <td>&nbsp;&nbsp;{{$value['completion_rate']}}%</td>
                <td>{{substr($value['review_date'], 0, 10)}}</td>
                <td>{{substr($value['development_date'], 0, 10)}}</td>
                <td>{{substr($value['testing_date'], 0, 10)}}</td>
                <td>{{substr($value['launch_date'], 0, 10)}}</td>
                <td>{{$value['collaborators']}}</td>
                <td>{{$value['remarks']}}</td>
            </tr>
                @endforeach
            @endforeach
    </table>
    @endforeach
    </div>
</body>
</html>