@inject('UserPresenter','App\Presenters\Admin\UserPresenter')
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
        <li class="active">{{trans('admin/user.edit')}}</li>
    </ol>
@endsection
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{trans('admin/user.edit')}}</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form method="post"  role="form" action="{{url('admin/user',$user->id)}}"  id="createForm">
            <div class="box-body">
                {!!csrf_field()!!}
                {{method_field('PUT')}}
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name">{{trans('admin/user.model.name')}}</label>
                    <input type="text" name="name" value="{{$user->name}}" id="name" class="form-control" placeholder="{{trans('admin/user.model.name')}}"  required autofocus>
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">{{trans('admin/user.model.email')}}</label>
                    <input type="email" name="email" value="{{ $user->email }}" id="email" class="form-control" placeholder="{{trans('admin/user.model.email')}}" required>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('role') ? ' has-error' : '' }}">
                    <label for="role">{{trans('admin/user.model.choose_role')}}</label>
                    <div class="form-inline">
                        {!! $UserPresenter->getUserRoleHtml($roleList,$user) !!}
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
@section('js')
    <script>
        window.Echo = new Echo({
            broadcaster: 'pusher',
            key: 'youxu',
            cluster: 'eu',
            encrypted: true
        });
    </script>
    @endsection

