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
        <li class="active">{{trans('admin/contro.create')}}</li>
    </ol>
@endsection
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{trans('admin/contro.create')}}</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form method="post" action="{{url('admin/contro')}}"  id="createForm">
            <div class="box-body">
                {!!csrf_field()!!}
                <div class="form-group{{ $errors->has('compose_id') ? ' has-error' : '' }}">
                    <label for="compose_id">{{trans('admin/contro.model.compose_id')}}</label>
                    {!! $ControPresenter->getComposeSelect($composeList,$compose_id) !!}
                </div>

                <div class="form-group{{ $errors->has('func_name') ? ' has-error' : '' }}">
                    <label for="func_name">{{trans('admin/contro.model.func_name')}}</label>
                    <input type="hidden" name="controller_id" value="0" />
                    <input type="hidden" name="compose_id" value="{{$compose_id}}" />
                    <input type="text" name="func_name" value="{{ old('func_name') }}" id="func_name" class="form-control" placeholder="{{trans('admin/contro.model.func_name')}}">
                </div>
                <div class="form-group{{ $errors->has('func_name_cn') ? ' has-error' : '' }}">
                    <label for="func_name_cn">{{trans('admin/contro.model.func_name_cn')}}</label>
                    <input type="text" name="func_name_cn" value="{{ old('func_name_cn') }}" id="func_name_cn" class="form-control" placeholder="{{trans('admin/contro.model.func_name_cn')}}">
                </div>
                <div class="form-group">
                    <label for="sort">{{trans('admin/contro.model.icon')}}</label>
                    <input type="text" name="icon" value="{{ old('icon') }}" id="icon"  class="form-control" placeholder="{{trans('admin/contro.model.icon')}}">
                </div>
                <div class="form-group">
                    <label for="sort">{{trans('admin/contro.model.order_num')}}</label>
                    <input type="text" name="order_num" value="{{ old('order_num') }}" id="order_num"  class="form-control" placeholder="{{trans('admin/contro.model.order_num')}}">
                </div>
                <div class="form-group">
                    <label for="sort">{{trans('admin/contro.model.active')}}</label>
                    <input type="text" name="active" value="{{ old('active') }}" id="active"  class="form-control" placeholder="{{trans('admin/contro.model.active')}}">
                </div>
                <div class="form-group">
                    <label for="sort">{{trans('admin/contro.model.url')}}</label>
                    <input type="text" name="url" value="{{ old('url') }}" id="url"  class="form-control" placeholder="{{trans('admin/contro.model.url')}}">
                </div>
                <div class="form-group">
                    <label for="is_menu">{{trans('admin/contro.model.is_menu')}}</label>
                    <div class="form-inline">
                        <input type="radio" name="is_menu"  checked="checked" value="1">{{trans('admin/action.radio_true')}}
                        <input type="radio" name="is_menu" value="0">{{trans('admin/action.radio_false')}}
                    </div>
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

