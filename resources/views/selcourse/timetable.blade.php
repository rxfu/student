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
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th colspan="2" class="active">节次</th>
                                <th class="active">星期一</th>
                                <th class="active">星期二</th>
                                <th class="active">星期三</th>
                                <th class="active">星期四</th>
                                <th class="active">星期五</th>
                                <th class="active">星期六</th>
                                <th class="active">星期日</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th colspan="2">节次</th>
                                <th>星期一</th>
                                <th>星期二</th>
                                <th>星期三</th>
                                <th>星期四</th>
                                <th>星期五</th>
                                <th>星期六</th>
                                <th>星期日</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @for ($i = 1; $i <= 5; ++$i)
                                <tr>
                                    @if (1 == $i)
                                        <th rowspan="5" class="active text-center">上午</th>
                                    @endif
                                    <th class="active">第{{ $i }}节</th>
                                    @for ($j = 1; $j <= 7; ++$j)
                                    	<?php $rows = isset($courses[$i][$j]['rows']) ? array_pull($courses[$i][$j], 'rows') : 1?>
										<?php $conflict                        = isset($courses[$i][$j]['conflict']) ? array_pull($courses[$i][$j], 'conflict') : false?>
                                    	@if (isset($courses[$i][$j]))
                                    		@if ($rows)
                                    			<td{!! 1 < $rows ? ' rowspan="' . $rows . '"' : '' !!}{!! isset($courses[$i][$j]) ? ($conflict ? ' class="danger"' : ' class="warning"') : '' !!}>
	                                    			@foreach ($courses[$i][$j] as $course)
	                                    				<p>
	                                    					<div class="text-danger"><strong>{{ $course['kcmc'] }}</strong></div>
		                                					<div>第 {{ $course['ksz'] === $course['jsz'] ? $course['ksz'] : $course['ksz'] . ' ~ ' . $course['jsz'] }} 周</div>
	                                						<div class="text-success">第 {{ $course['ksj'] === $course['jsj'] ? $course['ksj'] : $course['ksj'] . ' ~ ' . $course['jsj'] }} 节</div>
		                                					<div class='text-warning'>{{ empty($course['xqh']) ? '未知' : $course['xqh'] }}校区{{ empty($course['js']) ? '未知' : $course['js'] }}教室</div>
		                                					<div class='text-info'>{{ empty($course['jsxm']) ? '未知老师' : $course['jsxm'] . ' ' . $course['zc'] }}</div>
	                                    				</p>
	                                    			@endforeach
                                    			</td>
                                    		@endif
                                    	@else
                                    		<td></td>
                                    	@endif
                                    @endfor
                                </tr>
                            @endfor
                            <tr>
                                <td colspan="9" class="text-center">午休</td>
                            </tr>
                            @for ($i = 6; $i <= 9; ++$i)
                                <tr>
                                    @if (6 == $i)
                                        <th rowspan="4" class="active text-center">下午</th>
                                    @endif
                                    <th class="active">第{{ $i }}节</th>
                                    @for ($j = 1; $j <= 7; ++$j)
                                    	<?php $rows = isset($courses[$i][$j]['rows']) ? array_pull($courses[$i][$j], 'rows') : 1?>
										<?php $conflict                        = isset($courses[$i][$j]['conflict']) ? array_pull($courses[$i][$j], 'conflict') : false?>
                                    	@if (isset($courses[$i][$j]))
                                    		@if ($rows)
                                    			<td{!! 1 < $rows ? ' rowspan="' . $rows . '"' : '' !!}{!! isset($courses[$i][$j]) ? ($conflict ? ' class="danger"' : ' class="warning"') : '' !!}>
	                                    			@foreach ($courses[$i][$j] as $course)
	                                    				<p>
	                                    					<div class="text-danger"><strong>{{ $course['kcmc'] }}</strong></div>
		                                					<div>第 {{ $course['ksz'] === $course['jsz'] ? $course['ksz'] : $course['ksz'] . ' ~ ' . $course['jsz'] }} 周</div>
	                                						<div class="text-success">第 {{ $course['ksj'] === $course['jsj'] ? $course['ksj'] : $course['ksj'] . ' ~ ' . $course['jsj'] }} 节</div>
		                                					<div class='text-warning'>{{ empty($course['xqh']) ? '未知' : $course['xqh'] }}校区{{ empty($course['js']) ? '未知' : $course['js'] }}教室</div>
		                                					<div class='text-info'>{{ empty($course['jsxm']) ? '未知老师' : $course['jsxm'] . ' ' . $course['zc'] }}</div>
	                                    				</p>
	                                    			@endforeach
                                    			</td>
                                    		@endif
                                    	@else
                                    		<td></td>
                                    	@endif
                                    @endfor
                                </tr>
                            @endfor
                            <tr>
                                <td colspan="9" class="text-center">晚饭</td>
                            </tr>
                            @for ($i = 10; $i <= 12; ++$i)
                                <tr>
                                    @if (10 == $i)
                                        <th rowspan="3" class="active text-center">晚上</th>
                                    @endif
                                    <th class="active">第{{ $i }}节</th>
                                    @for ($j = 1; $j <= 7; ++$j)
                                    	<?php $rows = isset($courses[$i][$j]['rows']) ? array_pull($courses[$i][$j], 'rows') : 1?>
										<?php $conflict                        = isset($courses[$i][$j]['conflict']) ? array_pull($courses[$i][$j], 'conflict') : false?>
                                    	@if (isset($courses[$i][$j]))
                                    		@if ($rows)
                                    			<td{!! 1 < $rows ? ' rowspan="' . $rows . '"' : '' !!}{!! isset($courses[$i][$j]) ? ($conflict ? ' class="danger"' : ' class="warning"') : '' !!}>
	                                    			@foreach ($courses[$i][$j] as $course)
	                                    				<p>
	                                    					<div class="text-danger"><strong>{{ $course['kcmc'] }}</strong></div>
		                                					<div>第 {{ $course['ksz'] === $course['jsz'] ? $course['ksz'] : $course['ksz'] . ' ~ ' . $course['jsz'] }} 周</div>
	                                						<div class="text-success">第 {{ $course['ksj'] === $course['jsj'] ? $course['ksj'] : $course['ksj'] . ' ~ ' . $course['jsj'] }} 节</div>
		                                					<div class='text-warning'>{{ empty($course['xqh']) ? '未知' : $course['xqh'] }}校区{{ empty($course['js']) ? '未知' : $course['js'] }}教室</div>
		                                					<div class='text-info'>{{ empty($course['jsxm']) ? '未知老师' : $course['jsxm'] . ' ' . $course['zc'] }}</div>
	                                    				</p>
	                                    			@endforeach
                                    			</td>
                                    		@endif
                                    	@else
                                    		<td></td>
                                    	@endif
                                    @endfor
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel-footer">生成时间：{{ date('Y-m-d H:i:s') }}</div>
        </div>
    </div>
</section>
@stop