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
        @include('flash::message')
    </div>
@endsection
@section('js')
    <script src="{{asset('vendors/layer/layer.js')}}"></script>
    <script type="text/javascript">
        $('#flash-overlay-modal').modal();
    </script>
@endsection
