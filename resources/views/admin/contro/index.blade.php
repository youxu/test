@inject('ControPresenter','App\Presenters\Admin\controPresenter')
@extends('layouts.index')
@section('ContentHeader')
    <h1>
        Page Header
        <small>Optional description</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">{{trans('admin/contro.desc')}}</li>
    </ol>

@endsection
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{trans('admin/contro.desc')}}</h3>
            <div class=" pull-right">
                <div class="btn-group">
                    <button type="button" onclick="window.location.href='{{url('admin/contro/create',$compose_id)}}'" class="btn btn-primary">添加控制器</button>

                </div>
            </div>
        </div>
        <div class="box-body">
            @include('flash::message')
            <table class="table table-bordered" id="compose_list">
                <tbody>
                <tr>
                    <th style="width: 10px">{{trans('admin/contro.model.id')}}</th>
                    <th>{{trans('admin/contro.model.compose_id')}}</th>
                    <th>{{trans('admin/contro.model.func_name')}}</th>
                    <th>{{trans('admin/contro.model.func_name_cn')}}</th>
                    <th>{{trans('admin/contro.model.is_menu')}}</th>
                    <th>{{trans('admin/contro.model.icon')}}</th>
                    <th style="width: 100px">{{trans('admin/action.title')}}</th>
                </tr>
                {!!$ControPresenter->getControllerList($ControllerList)!!}
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{asset('vendors/layer/layer.js')}}"></script>
    <script type="text/javascript">
        $('#flash-overlay-modal').modal();
        $('#compose_list').on('click','.destroy_item',function() {
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

