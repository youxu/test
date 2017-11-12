@inject('ControPresenter','App\Presenters\Admin\controPresenter')
@extends('layouts.index')
@section('ContentHeader')
    <h1>
        Page Header
        <small>Optional description</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">{{trans('admin/contro.fun.desc')}}</li>
    </ol>

@endsection
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{trans('admin/contro.fun.dblist')}}</h3>
        </div>
        <form method="post" name="updateMethod" action="{{url('admin/contro/update_method')}}">
        <div class="box-body">
            <table class="table table-bordered" id="compose_list">
                <tbody>
                <tr>
                    <th style="width: 10px">{{trans('admin/contro.model.id')}}</th>
                    <th>{{trans('admin/contro.model.func_name')}}</th>
                    <th>{{trans('admin/contro.model.func_name_cn')}}</th>
                    <th>{{trans('admin/contro.model.is_menu')}}</th>
                    <th>{{trans('admin/contro.model.is_right')}}</th>
                    <th>{{trans('admin/contro.model.icon')}}</th>
                    <th>{{trans('admin/contro.model.active')}}</th>
                    <th>{{trans('admin/contro.model.url')}}</th>
                    <th>{{trans('admin/contro.model.order_num')}}</th>
                </tr>
                @foreach($method_list['row_list'] as $rl)
                    <tr>
                        <td>{{$rl->id}}</td>
                        <td>
                            {{$rl->func_name}}
                        </td>
                        <td>
                            {!!csrf_field()!!}
                            <input type="text" name="update[{{$loop->index}}][func_name_cn]" value="{{$rl->func_name_cn}}" />
                            <input type="hidden" name="update[{{$loop->index}}][id]" value="{{$rl->id}}" />
                            <input type="hidden" value="{{$rl->compose->en_name}}" name="update[{{$loop->index}}][compose_en_name]" />
                            <input type="hidden" value="{{$rl->func_name}}" name="update[{{$loop->index}}][func_name]" />
                            <input type="hidden" value="{{$contro->func_name}}" name="update[{{$loop->index}}][controller_name]" />
                            <input type="hidden" value="{{$rl->permission_id}}" name="update[{{$loop->index}}][permission_id]" />

                        </td>
                        <td>
                            <input type="radio" name="update[{{$loop->index}}][is_menu]"  {{is_checked(1,$rl->is_menu)}} value="1">{{trans('admin/action.radio_true')}}
                            <input type="radio" name="update[{{$loop->index}}][is_menu]"  {{is_checked(0,$rl->is_menu)}}  value="0">{{trans('admin/action.radio_false')}}
                        </td>
                        <td>
                            <input type="radio" name="update[{{$loop->index}}][is_right]"  {{is_checked(1,$rl->is_right)}}  value="1">{{trans('admin/action.radio_true')}}
                            <input type="radio" name="update[{{$loop->index}}][is_right]" {{is_checked(0,$rl->is_right)}}  value="0">{{trans('admin/action.radio_false')}}
                        </td>
                        <td>
                            <input type="text" name="update[{{$loop->index}}][icon]" value="{{$rl->icon}}"  /> <span class="fa {{$rl->icon}}"></span>
                        </td>
                        <td>
                            <input type="text" name="update[{{$loop->index}}][active]" value="{{$rl->active}}"  /> <span class="fa {{$rl->active}}"></span>
                        </td>
                        <td>
                            <input type="text" name="update[{{$loop->index}}][url]" value="{{$rl->url}}"  />
                        </td>
                        <td>
                            <input type="text" name="update[{{$loop->index}}][order_num]" value="{{$rl->order_num}}"  />
                        </td>
                    </tr>
                @endforeach
                <input type="hidden" name="contro_id" value="{{$contro_id}}" />
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix">
            <div class="btn-group pull-right">
                <button type="submit"  class="btn btn-primary">提交</button>
            </div>
        </div>
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        </form>
        <div class="box-header with-border">
            <h3 class="box-title">{{trans('admin/contro.fun.filelist')}}</h3>
        </div>
        <form method="post" action="{{url('admin/contro/store_method')}}">
        <div class="box-body">
            @include('flash::message')
            <table class="table table-bordered" id="compose_list">
                <tbody>
                <tr>
                    <th>{{trans('admin/contro.model.func_name')}}</th>
                    <th>{{trans('admin/contro.model.func_name_cn')}}</th>
                    <th>{{trans('admin/contro.model.is_menu')}}</th>
                    <th>{{trans('admin/contro.model.is_right')}}</th>
                    <th>{{trans('admin/contro.model.icon')}}</th>
                    <th>{{trans('admin/contro.model.active')}}</th>
                    <th>{{trans('admin/contro.model.url')}}</th>
                </tr>
                @foreach($method_list['controller_methods'] as $ml)
                    <tr>
                        <td>{{$ml}}
                            <input type="hidden" value="{{$ml}}" name="create[{{$loop->index}}][func_name]" />
                        </td>
                        <td class="form-group {{ $errors->has('create.'.$loop->index.'.func_name_cn') ? ' has-error' : '' }}">
                            {!!csrf_field()!!}
                            <input type="text" name="create[{{$loop->index}}][func_name_cn]" class="form-control" value="" />
                        </td>
                        <td>
                            <input type="radio" name="create[{{$loop->index}}][is_menu]"  checked="checked" value="1">{{trans('admin/action.radio_true')}}
                            <input type="radio" name="create[{{$loop->index}}][is_menu]" value="0">{{trans('admin/action.radio_false')}}
                        </td>
                        <td >
                            <input type="radio" name="create[{{$loop->index}}][is_right]"  checked="checked" value="1">{{trans('admin/action.radio_true')}}
                            <input type="radio" name="create[{{$loop->index}}][is_right]" value="0">{{trans('admin/action.radio_false')}}
                        </td>
                        <td>
                            <input type="text" name="create[{{$loop->index}}][icon]"  />
                        </td>
                        <td>
                            <input type="text" name="create[{{$loop->index}}][active]"  />
                        </td>
                        <td>
                            <input type="text" name="create[{{$loop->index}}][url]"  />
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix">
            <div class="btn-group pull-right">
                <button type="submit"  class="btn btn-primary">提交</button>
            </div>
        </div>
        <input type="hidden" name="contro_id" value="{{$contro_id}}" />
        </form>
    </div>
@endsection
@section('js')
    <script src="{{asset('vendors/layer/layer.js')}}"></script>
    <script type="text/javascript">
        $('#flash-overlay-modal').modal();
    </script>
@endsection

