@inject('ControPresenter','App\Presenters\Admin\ControPresenter')
@extends('layouts.index')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/ladda/ladda-themeless.min.css')}}">
@endsection
@section('ContentHeader')
    <h1>
        Page Header
        <small>Optional description</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">{{trans('admin/user.create')}}</li>
    </ol>
@endsection
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{trans('admin/user.create')}}</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form method="post"  role="form" action="{{url('admin/user')}}"  id="createForm">
            <div class="box-body">
                {!!csrf_field()!!}
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name">{{trans('admin/user.model.name')}}</label>
                    <input type="text" name="name" value="{{ old('name') }}" id="name" class="form-control" placeholder="{{trans('admin/user.model.name')}}"  required autofocus>
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">{{trans('admin/user.model.email')}}</label>
                    <input type="email" name="email" value="{{ old('email') }}" id="email" class="form-control" placeholder="{{trans('admin/user.model.email')}}" required>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password">{{trans('admin/user.model.password')}}</label>
                    <input type="password" name="password" value="{{ old('password') }}" id="password" class="form-control" placeholder="{{trans('admin/user.model.password')}}" required>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label for="re_password">{{trans('admin/user.model.password_confirmation')}}</label>
                    <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" id="password_confirmation" class="form-control" placeholder="{{trans('admin/user.model.password_confirmation')}}" required>
                    @if ($errors->has('re_password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('re_password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('role') ? ' has-error' : '' }}">
                    <label for="role">{{trans('admin/user.model.choose_role')}}</label>
                    <div class="form-inline">
                    @foreach($roleLIst as $value)
                        <input type="checkbox" name="role[]" value="{{$value->id}}">{{$value->display_name}}&nbsp;
                    @endforeach
                    </div>
                    @if ($errors->has('role'))
                        <span class="help-block">
                            <strong>{{ $errors->first('role') }}</strong>
                        </span>
                    @endif
                </div>


            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn  btn-primary createButton">
                <span class="ladda-label">
                    {!!trans('admin/action.actionButton.submit')!!}
                </span>

                </button>
            </div>
        </form>
    </div>
@endsection


