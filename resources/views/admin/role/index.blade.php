@inject('RolePresenter','App\Presenters\Admin\RolePresenter')
@extends('layouts.index')
@section('ContentHeader')
    <h1>
        Page Header
        <small>Optional description</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">{{trans('admin/role.desc')}}</li>
    </ol>
@endsection
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{trans('admin/role.desc')}}</h3>
        </div>
        <div class="box-body">
            @include('flash::message')
            <table class="table table-bordered" id="compose_list">
                <tbody>
                <tr>
                    <th style="width: 10px">{{trans('admin/role.model.id')}}</th>
                    <th>{{trans('admin/role.model.name')}}</th>
                    <th>{{trans('admin/role.model.display_name')}}</th>
                    <th>{{trans('admin/role.model.description')}}</th>
                    <th style="width: 100px">{{trans('admin/action.title')}}</th>
                </tr>
                {!!$RolePresenter->getRoleList($roles)!!}
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix">
            {!! $roles->links()!!}
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

