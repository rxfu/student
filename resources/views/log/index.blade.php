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
                                <th class="active">操作时间</th>
                                <th class="active">IP地址</th>
                                <th class="active">课程序号</th>
                                <th class="active">操作类型</th>
                                <th class="active">备注</th>
                            </tr>
                        </thead>
                        <tbody>
                        	@foreach ($logs as $log)
                        	<tr>
                                <td>{{ $log['czsj'] }}</td>
                                <td>{{ $log['ip'] }}</td>
                                <td>{{ $log['kcxh'] }}</td>
                                <td>{{ Config::get('constants.log.' . $log['czlx']) }}</td>
                                <td>{{ $log['bz'] }}</td>
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