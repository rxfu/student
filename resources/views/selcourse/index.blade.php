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
                                <th class="active">校区</th>
                                <th class="active">周一</th>
                                <th class="active">周二</th>
                                <th class="active">周三</th>
                                <th class="active">周四</th>
                                <th class="active">周五</th>
                                <th class="active">周六</th>
                                <th class="active">周日</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>课程代码</th>
                                <th>课程名称</th>
                                <th>学分</th>
                                <th>校区</th>
                                <th>周一</th>
                                <th>周二</th>
                                <th>周三</th>
                                <th>周四</th>
                                <th>周五</th>
                                <th>周六</th>
                                <th>周日</th>
                            </tr>
                        </tfoot>
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
                                					<p>
	                                					<div>第 {{ $class['ksz'] === $class['jsz'] ? $class['ksz'] : $class['ksz'] . ' ~ ' . $class['jsz'] }} 周</div>
	                                					<div class="text-danger"><strong>第 {{ $class['ksj'] === $class['jsj'] ? $class['ksj'] : $class['ksj'] . ' ~ ' . $class['jsj'] }} 节</strong></div>
	                                					<div class='text-warning'>{{ empty($class['js']) ? '未知' : $class['js'] }}教室</div>
	                                					<div class='text-info'>{{ empty($class['jsxm']) ? '' : $class['jsxm'] . ' ' . $class['zc'] }}</div>
                                					</p>
                                				@endforeach
                                			@endif
                                		</td>
                                	@endfor
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