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
                        <tbody>
                        	@for ($i = $periods['morning']['begin']; $i <= $periods['evening']['end']; ++$i)
                                <tr>
                            		@if ($id = array_search($i, array_column($periods, 'begin', 'id')))
                                        <th rowspan="{{ $periods[$id]['end'] - $periods[$id]['begin'] + 1 }}" class="active text-cener">{{ $periods[$id]['name'] }}</th>
                            		@endif
                                    <th class="active">第{{ $i }}节</th>
                                    @for ($j = 1; $j <= 7; ++$j)
                                        <?php $rows     = isset($courses[$i][$j]['rows']) ? array_pull($courses[$i][$j], 'rows') : 1?>
                                        <?php $conflict = isset($courses[$i][$j]['conflict']) ? array_pull($courses[$i][$j], 'conflict') : false?>
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
                                @if ($id = array_search($i, array_column($periods, 'end', 'id')))
	                                <tr>
	                                    <td colspan="9" class="active text-center">{{ $periods[$id]['rest'] }}</td>
	                                </tr>
                                @endif
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