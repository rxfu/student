@extends('app')

@section('content')
<section class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="table-responsive tab-table">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="active">操作</th>
                                <th class="active">课程序号</th>
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
                                <th class="active">考核方式</th>
                                <th class="active">上课人数</th>
                                <th class="active">已选人数</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($courses as $course)
                            	<tr>
                            		<td>
                                        <form id="deleteForm" name="deleteForm" action="{{ route('selcourse.destroy', $course['kcxh'])}}" method="post" role="form">
                                            {!! method_field('delete') !!}
                                            {!! csrf_field() !!}
                                            <button type="submit" class="btn btn-danger">退课</button>
                                        </form>
                                    </td>
                            		<td>{{ $course['kcxh'] }}</td>
                            		<td>{{ $course['kcmc'] }}</td>
                            		<td>{{ $course['xf'] }}</td>
                                	<td>{{ $course['xqmc'] }}</td>
                                	@for ($week = 1; $week <= 7; $week++)
                                		<td{!! isset($course[$week]) ? ' class="warning"' : '' !!}>
                                			@if (isset($course[$week]))
                                				@foreach ($course[$week] as $class)
                                					<p>
	                                					<div>第 {{ $class['ksz'] === $class['jsz'] ? $class['ksz'] : $class['ksz'] . ' ~ ' . $class['jsz'] }} 周</div>
	                                					<div class="text-danger"><strong>第 {{ $class['ksj'] === $class['jsj'] ? $class['ksj'] : $class['ksj'] . ' ~ ' . $class['jsj'] }} 节</strong></div>
	                                					<div class='text-info'>{{ empty($class['jsxm']) ? '未知老师' : $class['jsxm'] . ' 老师' }}</div>
                                					</p>
                                				@endforeach
                                			@endif
                                		</td>
                                	@endfor
                            		<td>{{ $course['kh'] }}</td>
                            		<td>{{ $course['zrs'] }}</td>
                            		<td>{{ $course['rs'] }}</td>
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