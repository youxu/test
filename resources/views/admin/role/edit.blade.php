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
        <li class="active">{{trans('admin/role.edit')}}</li>
    </ol>
@endsection
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{trans('admin/role.edit')}}</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form method="post" action="{{url('admin/role',[$role->id])}}"  id="createForm">
            <div class="box-body">
                {!!csrf_field()!!}{{method_field('PUT')}}
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="cn_name">{{trans('admin/role.model.name')}}</label>
                    <input type="hidden" name="id" value="{{$role->id}}" />
                    <input type="text" name="name" id="name" value="{{ $role->name }}" class="form-control" placeholder="{{trans('admin/role.model.name')}}">
                </div>
                <div class="form-group{{ $errors->has('display_name') ? ' has-error' : '' }}">
                    <label for="cn_name">{{trans('admin/role.model.display_name')}}</label>
                    <input type="text" name="display_name" value="{{ $role->display_name }}" id="display_name" class="form-control" placeholder="{{trans('admin/role.model.display_name')}}">
                </div>

                <div class="form-group">
                    <label for="sort">{{trans('admin/role.model.description')}}</label>
                    <input type="text" name="description" value="{{ $role->description }}" id="description"  class="form-control" placeholder="{{trans('admin/role.model.description')}}">
                </div>
                <div class="form-group">
                    <h4 class="cn_name">{{trans('admin/role.chooseRole')}}</h4>
                    @foreach($roleList as $value)
                        <label for="user_name">{{$value['func_name_cn']}}</label>
                        @if(count($value['child']>0))
                            <div class="checkbox">
                                @foreach($value['child'] as $childValue)
                                    <label>
                                        <input type="checkbox" name="permissions[]" @if(in_array($childValue['permission_id'],$permissionRole)) checked @endif value="{{$childValue['permission_id']}}" />
                                        {{$childValue['func_name_cn']}}
                                    </label>
                                @endforeach
                            </div>
                        @endif
                    @endforeach
                </div>

            </div>
            <!-- /.box-body -->
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="box-footer">
                <button type="submit" class="btn ladda-button btn-primary createButton">
                <span class="ladda-label">
                    {!!trans('admin/action.actionButton.submit')!!}
                </span>
                    <span class="ladda-spinner"></span>
                    <div class="ladda-progress" style="width: 0px;"></div>
                </button>
            </div>
        </form>
    </div>
@endsection
@section('js')
    <script src="{{asset('vendors/ladda/spin.min.js')}}"></script>
    <script src="{{asset('vendors/ladda/ladda.min.js')}}"></script>
    <script src="{{asset('vendors/ladda/ladda.jquery.min.js')}}"></script>
    <script src="{{asset('vendors/layer/layer.js')}}"></script>
    <script src="{{asset('/admin/js/menu.js')}}"></script>
@endsection

