@inject('ComposePresenter','App\Presenters\Admin\ComposePresenter')
@extends('layouts.index')
@section('ContentHeader')
    <h1>
        Page Header
        <small>Optional description</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">{{trans('admin/compose.list')}}</li>
    </ol>
@endsection
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{trans('admin/compose.list')}}</h3>
            <div class=" pull-right">
                <div class="btn-group">
                    <button type="button" onclick="window.location.href='{{url('admin/compose/create')}}'" class="btn btn-primary">添加组件</button>
                </div>
            </div>
        </div>
        <div class="box-body">
            @include('flash::message')
            <table class="table table-bordered" id="compose_list">
                <tbody>
                <tr>
                    <th style="width: 10px">{{trans('admin/compose.model.id')}}</th>
                    <th>{{trans('admin/compose.model.cn_name')}}</th>
                    <th>{{trans('admin/compose.model.en_name')}}</th>
                    <th>{{trans('admin/compose.model.status')}}</th>
                    <th>{{trans('admin/compose.model.is_show')}}</th>
                    <th style="width: 100px">{{trans('admin/action.title')}}</th>
                </tr>
                {!!$ComposePresenter->getComposeList($list)!!}
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix">
            {!! $list->links()!!}
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

