@extends('app')

@section('content')
<section class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">生成时间：{{ date('Y-m-d H:i:s') }}</div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="active">课程代码</th>
                                <th class="active">课程名称</th>
                                <th class="active">学分</th>
                                <th class="active">所在校区</th>
                                <th class="active">周一</th>
                                <th class="active">周二</th>
                                <th class="active">周三</th>
                                <th class="active">周四</th>
                                <th class="active">周五</th>
                                <th class="active">周六</th>
                                <th class="active">周日</th>
                                <th class="active">开始周</th>
                                <th class="active">结束周</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($courses as $course)
                                <tr>
                                	<td>{{ $course['kcxh'] }}</td>
                                	<td>{{ $course['kcmc'] }}</td>
                                	<td>{{ $course['xf'] }}</td>
                                	<td>{{ $course['xqh'] }}</td>
                                	@for ($week = 1; $week <= 7; $week++)
                                		<td{!! isset($course[$week]) ? ' class="success"' : '' !!}>
                                			@if (isset($course[$week]))
                                				@foreach ($course[$week] as $class)
                                					第 {{ $class['ksj'] }} ~ {{ $class['jsj'] }} 节<br>
                                					{{ empty($class['js']) ? '' : $class['js'] . '教室' }}<br>
                                					{{ empty($class['jsxm']) ? '' : $class['jsxm'] }}<br>
                                				@endforeach
                                			@endif
                                		</td>
                                	@endfor
                                	<td>{{ $course['ksz'] }}</td>
                                	<td>{{ $course['jsz'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel-footer">生成时间：{{ date('Y-m-d H:i:s') }}</div>
        </div>
    </div>
</section>
@stop