@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card row">
                <div class="card-header"><a href="/">周报</a> > {{ __('工作详情') }}</div>

                <div class="card-body">
                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('标题') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{$title}}" disabled autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="schedule" class="col-md-4 col-form-label text-md-right">{{ __('进度') }}</label>

                            <div class="col-md-6">
                                <input id="schedule" type="text" class="form-control" name="schedule" value="{{$schedule}}" disabled autofocus>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="completion_rate" class="col-md-4 col-form-label text-md-right">{{ __('完成百分比') }}</label>

                            <div class="col-md-6">
                                <input id="completion_rate" type="text" class="form-control" name="completion_rate" value="{{ $completion_rate }}%" disabled autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="review_date" class="col-md-4 col-form-label text-md-right">{{ __('评审日期') }}</label>

                            <div class="col-md-6">
                                <input id="review_date" type="text" class="form-control" name="review_date" value="{{ $review_date }}" disabled autofocus>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="development_date" class="col-md-4 col-form-label text-md-right">{{ __('评审日期') }}</label>

                            <div class="col-md-6">
                                <input id="development_date" type="text" class="form-control" name="development_date" value="{{ $development_date }}" disabled autofocus>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="testing_date" class="col-md-4 col-form-label text-md-right">{{ __('测试日期') }}</label>

                            <div class="col-md-6">
                                <input id="testing_date" type="text" class="form-control" name="testing_date" value="{{ $testing_date }}" disabled autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="launch_date" class="col-md-4 col-form-label text-md-right">{{ __('上线日期') }}</label>

                            <div class="col-md-6">
                                <input id="launch_date" type="text" class="form-control" name="launch_date" value="{{ $launch_date }}" disabled autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="launch_date" class="col-md-4 col-form-label text-md-right">{{ __('已删除') }}</label>

                            <div class="col-md-6">
                                <input id="launch_date" type="text" class="form-control" name="launch_date" value="{{ $delete ? '是':'否' }}" disabled autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="remarks" class="col-md-4 col-form-label text-md-right">{{ __('备注') }}</label>

                            <div class="col-md-6">
                                <textarea id="remarks" name="remarks" class="form-control{{ $errors->has('remarks') ? ' is-invalid' : '' }}" rows="3" disabled>{{ $remarks }}</textarea>
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a href="/assignment/edit/{{$id}}" class="btn btn-primary" role="button">{{ __('修改') }}</a>
                                <a href="/assignment/delete/{{$id}}" class="btn btn-danger" role="button">{{ __('删除') }}</a>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
