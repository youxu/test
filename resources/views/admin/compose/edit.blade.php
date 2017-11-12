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
        <li class="active">{{trans('admin/compose.edit')}}</li>
    </ol>
@endsection
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{trans('admin/compose.edit')}}</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form method="post" action="{{url('admin/compose',[$compose->id])}}"  id="EditForm">
            <div class="box-body">
                {!!csrf_field()!!}
                {{method_field('PUT')}}
                <input type="hidden" name="id" value="{{$compose->id}}" />
                <div class="form-group{{ $errors->has('cn_name') ? ' has-error' : '' }}">
                    <label for="cn_name">{{trans('admin/compose.model.cn_name')}}</label>
                    <input type="text" name="cn_name" id="cn_name" value="{{$compose->cn_name}}" class="form-control" placeholder="{{trans('admin/compose.model.cn_name')}}">
                    @if ($errors->has('cn_name'))
                        <span class="help-block m-b-none text-danger">{{ $errors->first('cn_name') }}</span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('en_name') ? ' has-error' : '' }}">
                    <label for="cn_name">{{trans('admin/compose.model.en_name')}}</label>
                    <input type="text" name="en_name" id="en_name" value="{{$compose->en_name}}" class="form-control" placeholder="{{trans('admin/compose.model.en_name')}}">
                    @if ($errors->has('en_name'))
                        <span class="help-block m-b-none text-danger">{{ $errors->first('en_name') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="sort">{{trans('admin/compose.model.order_num')}}</label>
                    <input type="text" name="order_num" id="order_num" value="{{$compose->order_num}}" class="form-control" placeholder="{{trans('admin/compose.model.order_num')}}">
                </div>
                <div class="form-group{{ $errors->has('is_show') ? ' has-error' : '' }}">
                    <label for="cn_name">{{trans('admin/compose.model.is_show')}}</label>
                    <div class="form-inline">
                        <input type="radio" name="is_show"  id="is_show"  {{is_checked($compose->getOriginal('is_show'),1)}}  value="1">{{trans('admin/action.radio_true')}}
                        <input type="radio" name="is_show" id="is_show" value="0" {{is_checked($compose->getOriginal('is_show'),0)}}>{{trans('admin/action.radio_false')}}
                    </div>
                    @if ($errors->has('is_show'))
                        <span class="help-block m-b-none text-danger">{{ $errors->first('is_show') }}</span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                    <label for="status">{{trans('admin/compose.model.status')}}</label>
                    <div class="form-inline">

                        <input type="radio" name="status"  {{is_checked($compose->getOriginal('status'),1)}} value="1">{{trans('admin/action.radio_true')}}
                        <input type="radio" name="status" value="0" {{is_checked($compose->getOriginal('status'),0)}}>{{trans('admin/action.radio_false')}}
                    </div>
                    @if ($errors->has('is_show'))
                        <span class="help-block m-b-none text-danger">{{ $errors->first('is_show') }}</span>
                    @endif
                </div>

            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn ladda-button btn-primary editButton">
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

