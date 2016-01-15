@extends('app')

@section('content')
<section class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover data-table">
                        <thead>
                            <tr>
                                <th class="active">发送者</th>
                                <th class="active">内容</th>
                                <th class="active">发送时间</th>
                                <th class="active">状态</th>
                            </tr>
                        </thead>
                        <tbody>
                        	@foreach ($messages as $message)
                            <tr>
                                <td>{{ $message['xxfsz'] }}</td>
                                <td>{{ $message['xxnr'] }}</td>
                                <td>{{ $message['fssj'] }}</td>
                                <td>{{ $message['ydbz'] }}</td>
                            </tr>
                        	@endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@stop