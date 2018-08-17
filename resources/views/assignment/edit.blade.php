@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card row">
                <div class="card-header"><a href="/">周报</a> > {{ __('修改工作') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('assignment.update') }}" aria-label="{{ __('添加') }}">
                        @csrf

                        <input type="hidden" name="id" value="{{ $id }}">

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('标题') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ $title }}" required autofocus>

                                @if ($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="schedule" class="col-md-4 col-form-label text-md-right">{{ __('进度') }}</label>

                            <div class="col-md-6">
                                {{--<input id="schedule" type="text" class="form-control{{ $errors->has('schedule') ? ' is-invalid' : '' }}" name="schedule" value="{{ $schedule }}" required autofocus>--}}

                                <select id="schedule" name="schedule" class="form-control{{ $errors->has('schedule') ? ' is-invalid' : '' }} input-lg" required autofocus>
                                    <option value="planning" {{$schedule == 'planning'?'selected':''}}>计划中</option>
                                    <option value="reviewing" {{$schedule == 'reviewing'?'selected':''}}>评审中</option>
                                    <option value="developing" {{$schedule == 'developing'?'selected':''}}>开发中</option>
                                    <option value="launched" {{$schedule == 'launched'?'selected':''}}>已上线</option>
                                    <option value="end" {{$schedule == 'end'?'selected':''}}>已结束</option>
                                </select>

                                @if ($errors->has('schedule'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('schedule') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="completion_rate" class="col-md-4 col-form-label text-md-right">{{ __('完成百分比') }}</label>

                            <div class="col-md-6">
                                <input id="completion_rate" type="number" class="form-control{{ $errors->has('completion_rate') ? ' is-invalid' : '' }}" name="completion_rate" value="{{ $completion_rate }}" required autofocus>

                                @if ($errors->has('completion_rate'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('completion_rate') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="review_date" class="col-md-4 col-form-label text-md-right">{{ __('评审日期') }}</label>

                            <div class="col-md-6">
                                <input id="review_date" type="text" class="form-control{{ $errors->has('review_date') ? ' is-invalid' : '' }}" name="review_date" value="{{ $review_date }}" required autofocus>

                                @if ($errors->has('review_date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('review_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="development_date" class="col-md-4 col-form-label text-md-right">{{ __('评审日期') }}</label>

                            <div class="col-md-6">
                                <input id="development_date" type="text" class="form-control{{ $errors->has('development_date') ? ' is-invalid' : '' }}" name="development_date" value="{{ $development_date }}" required autofocus>

                                @if ($errors->has('development_date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('development_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="testing_date" class="col-md-4 col-form-label text-md-right">{{ __('测试日期') }}</label>

                            <div class="col-md-6">
                                <input id="testing_date" type="text" class="form-control{{ $errors->has('testing_date') ? ' is-invalid' : '' }}" name="testing_date" value="{{ $testing_date }}" required autofocus>

                                @if ($errors->has('testing_date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('testing_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="launch_date" class="col-md-4 col-form-label text-md-right">{{ __('上线日期') }}</label>

                            <div class="col-md-6">
                                <input id="launch_date" type="text" class="form-control{{ $errors->has('launch_date') ? ' is-invalid' : '' }}" name="launch_date" value="{{ $testing_date }}" required autofocus>

                                @if ($errors->has('testing_date'))
                                    <span class="launch-feedback" role="alert">
                                        <strong>{{ $errors->first('launch_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="remarks" class="col-md-4 col-form-label text-md-right">{{ __('备注') }}</label>

                            <div class="col-md-6">
                                <textarea id="remarks" name="remarks" class="form-control{{ $errors->has('remarks') ? ' is-invalid' : '' }}" rows="3" autofocus>{{ $remarks }}</textarea>
                                @if ($errors->has('remarks'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('remarks') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('确定修改') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
