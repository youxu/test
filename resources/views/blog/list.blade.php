@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-1 col-sm-8">

        {{ csrf_field() }}

        <!-- Current Tasks -->
            @if (count($list) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Current Users
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped user-table">
                            <thead>
                            <th>ID</th>
                            <th>标题</th>
                            <th>作者</th>
                            </thead>
                            <tbody>
                            @foreach ($list as $l)
                                <tr>
                                    <td class="table-text"><div>{{ $l->id }}</div></td>
                                    <td class="table-text"><div>{{ $l->title }}</div></td>
                                    <td class="table-text"><div>{{ $l->count_comment }}</div></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection