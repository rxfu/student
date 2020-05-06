@extends('app')

@section('content')
<section class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="active">操作</th>
                                <th class="active">课程代码</th>
                                <th class="active">课程名称</th>
                                <th class="active">课程类型</th>
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
                                <th>操作</th>
                                <th>课程代码</th>
                                <th>课程名称</th>
                                <th>课程类型</th>
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
                                    <td align="center">
                                        <form id="transForm" name="transForm" action="{{ route('selcourse.tqtransform', $course['kcxh'])}}" method="post" role="form">
                                            {!! csrf_field() !!}
                                            @if ($course['cx'])
                                                <span class="text-danger">
                                                    <strong>重修课程<br>不可转换</strong>
                                                </span>
                                            @else
                                                @if ($course['xz'] == 'Q')
                                                    <button type="submit" class="btn btn-info">转回为T{{ substr($course['kcxh'], 1, 1) }}</button>
                                                @else
                                                    <button type="submit" class="btn btn-warning">转换为TQ</button>
                                                @endif
                                            @endif
                                        </form>
                                    </td>
                                	<td>{{ $course['kcxh'] }}</td>
                                	<td>{{ $course['kcmc'] }}</td>
                                    <td>{{ $course['pt'] . $course['xz'] }}</td>
                                	<td>{{ $course['xf'] }}</td>
                                	<td>{{ $course['xqh'] }}</td>
                                	@for ($week = 1; $week <= 7; $week++)
                                		<td{!! isset($course[$week]) ? ' class="warning"' : '' !!}>
                                			@if (isset($course[$week]))
                                				@foreach ($course[$week] as $class)
                                					<p>
	                                					<div>第 {{ $class['ksz'] === $class['jsz'] ? $class['ksz'] : $class['ksz'] . ' ~ ' . $class['jsz'] }} 周</div>
	                                					<div class="text-danger"><strong>第 {{ $class['ksj'] === $class['jsj'] ? $class['ksj'] : $class['ksj'] . ' ~ ' . $class['jsj'] }} 节</strong></div>
	                                					<div class='text-warning'>{{ empty($class['js']) ? '未知' : $class['js'] }}教室</div>
	                                					<div class='text-info'>{{ empty($class['jsxm']) ? '未知老师' : $class['jsxm'] . ' ' . $class['zc'] }}</div>
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
        </div>
    </div>
</section>
@stop