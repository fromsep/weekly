@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card row">
                <div class="card-header"><a href="/">周报</a> > {{ __('最近工作') }}</div>

                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>工作</th>
                                <th>进度</th>
                                <th>百分比</th>
                                <th>评审日期</th>
                                <th>开发日期</th>
                                <th>测试日期</th>
                                <th>上线日期</th>
                                <th>创建日期</th>
                                <th>详情</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list as $record)
                                <tr>
                                    <td>{{ $record->id }}</td>
                                    <td>{{ $record->title }}</td>
                                    <td>{{ $record->schedule }}</td>
                                    <td>{{ $record->completion_rate }}%</td>
                                    <td>{{ substr($record->review_date, 0, 10) }}</td>
                                    <td>{{ substr($record->development_date, 0, 10) }}</td>
                                    <td>{{ substr($record->testing_date, 0, 10) }}</td>
                                    <td>{{ substr($record->launch_date, 0, 10) }}</td>
                                    <td>{{ $record->create_time }}</td>
                                    <td><a href="/assignment/detail/{{ $record->id }}">详情</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
