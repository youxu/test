@inject('menuPresenter','App\Presenters\Admin\MenuPresenter')
@extends('layouts.index')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/nestable/nestable.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/ladda/ladda-themeless.min.css')}}">
@endsection
@section('ContentHeader')
    <h1>
        Page Header
        <small>Optional description</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">{{trans('admin/menu.desc')}}</li>
    </ol>
@endsection
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{trans('admin/menu.desc')}}</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <div class="content">
            @include('flash::message')
            <div class="dd" id="nestable">
                <ol class="dd-list">
                    {!!$menuPresenter->menuNestable($menus)!!}
                </ol>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{asset('vendors/nestable/jquery.nestable.js')}}"></script>
    <script src="{{asset('vendors/layer/layer.js')}}"></script>
    <script src="{{asset('/admin/js/menu.js')}}"></script>
    <script type="text/javascript">
        $('#flash-overlay-modal').modal();
        $('#nestable').on('click','.destroy_item',function() {
            var _item = $(this);
            var title = "{{trans('admin/alert.deleteTitle')}}";
            layer.confirm(title, {
                btn: ['{{trans('admin/action.actionButton.destroy')}}', '{{trans('admin/action.actionButton.no')}}'],
                icon: 5
            },function(index){
                _item.children('form').submit();
                layer.close(index);
            });
        });
    </script>
@endsection

