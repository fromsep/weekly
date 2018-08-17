@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card row">
                <div class="card-header"> {{ __('选择所属组') }}            </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('group.update') }}" aria-label="{{ __('添加') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="group_id" class="col-md-4 col-form-label text-md-right">{{ __('组') }}</label>

                            <div class="col-md-6">
                                {{--<input id="schedule" type="text" class="form-control{{ $errors->has('schedule') ? ' is-invalid' : '' }}" name="schedule" value="{{ old('schedule') }}" required autofocus>--}}
                                <select id="group_id" name="group_id" class="form-control{{ $errors->has('group_id') ? ' is-invalid' : '' }} input-lg" required autofocus>
                                    <option value=""></option>
                                    @foreach($groups as $group)
                                    <option value="{{$group->id}}">{{$group->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('group_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('group_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('提交') }}
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
