@inject('menuPresenter','App\Presenters\Admin\MenuPresenter')
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
        <li class="active">{{trans('admin/menu.edit')}}</li>
    </ol>
@endsection
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{trans('admin/menu.edit')}}</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form method="post" action="{{url('admin/menu',[$menu->id])}}"  id="editForm">
            <div class="box-body">
                {!!csrf_field()!!}{{method_field('PUT')}}

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name">{{trans('admin/menu.model.name')}}</label>
                    <input type="hidden" name="id" value="{{$menu->id}}" />
                    <input type="text" name="name" id="name" value="{{$menu->name}}" class="form-control" placeholder="{{trans('admin/menu.model.name')}}">
                    @if ($errors->has('name'))
                        <span class="help-block m-b-none text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="pid">{{trans('admin/menu.model.pid')}}</label>
                    <select class="form-control" name="pid">
                        {!!$menuPresenter->topMenuList($menus,$menu->pid)!!}
                    </select>
                </div>
                <div class="form-group{{ $errors->has('icon') ? ' has-error' : '' }}">
                    <label for="icon">{{trans('admin/menu.model.icon')}}</label>
                    <input type="text" class="form-control" name="icon" value="{{$menu->icon}}" id="icon" placeholder="{{trans('admin/menu.model.icon')}}" >

                    <p class="help-block">{!!trans('admin/menu.moreIcon')!!}</p>
                    @if ($errors->has('icon'))
                        <span class="help-block m-b-none text-danger">{{ $errors->first('icon') }}</span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                    <label for="slug">{{trans('admin/menu.model.slug')}}</label>
                    <input type="text" name="slug" id="slug" class="form-control" value="{{$menu->slug}}" placeholder="{{trans('admin/menu.model.slug')}}">
                    @if ($errors->has('slug'))
                        <span class="help-block m-b-none text-danger">{{ $errors->first('slug') }}</span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                    <label for="url">{{trans('admin/menu.model.url')}}</label>
                    <input type="text" name="url" id="url" class="form-control" value="{{$menu->url}}" placeholder="{{trans('admin/menu.model.url')}}">
                    @if ($errors->has('url'))
                        <span class="help-block m-b-none text-danger">{{ $errors->first('url') }}</span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('active') ? ' has-error' : '' }}">
                    <label for="active">{{trans('admin/menu.model.active')}}</label>
                    <input type="text" name="active" id="active" class="form-control" value="{{$menu->active}}" placeholder="{{trans('admin/menu.model.active')}}">
                    @if ($errors->has('active'))
                        <span class="help-block m-b-none text-danger">{{ $errors->first('active') }}</span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                    <label for="description">{{trans('admin/menu.model.description')}}</label>
                    <input type="text" name="description" id="description" class="form-control" value="{{$menu->description}}" placeholder="{{trans('admin/menu.model.description')}}">
                    @if ($errors->has('description'))
                        <span class="help-block m-b-none text-danger">{{ $errors->first('description') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="sort">{{trans('admin/menu.model.sort')}}</label>
                    <input type="text" name="sort" id="sort" class="form-control" value="{{$menu->sort}}" placeholder="{{trans('admin/menu.model.sort')}}">
                </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button class="btn btn-primary ladda-button editButton" data-style="contract-overlay"><span class="ladda-label">{!!trans('admin/action.actionButton.submit')!!}</span>
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

