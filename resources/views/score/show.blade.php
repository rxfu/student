@extends('app')

@section('content')
    @if (empty($ratios))
        <section class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body bg-warning">
                        <h3 class="text-center">无成绩单</h3>
                    </div>
                </div>
            </div>
        </section>
    @else
        @foreach ($ratios as $key => $values)
        <?php $scores = array_pull($values, 'score');?>
        <section class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                	<div class="panel-heading">
                		<div class="panel-title">
                		成绩组成方式：
                		@if ('000' === $key)
                			未知
                		@else
                			{{ implode(':', array_pluck($values, 'name')) }} = {{ implode(':', array_map(function($n) { return $n / 10; }, array_pluck($values, 'value'))) }}
                		@endif
                		</div>
                	</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th class="active">年度</th>
                                        <th class="active">学期</th>
                                        <th class="active">课程代码</th>
                                        <th class="active">课程名称</th>
                                        <th class="active">课程平台</th>
                                        <th class="active">课程性质</th>
                                        @foreach (array_pluck($values, 'name') as $name)
                                        	<th class="active">{{ $name }}</th>
                                        @endforeach
                                        <th class="active">总评成绩</th>
                                        <th class="active">考核方式</th>
                                        <th class="active">考试状态</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($scores as $score)
                                    <tr>
                                        <td>{{ App\Http\Helper::getAcademicYear($score->nd) }}</td>
                                        <td>{{ $score->term->mc }}</td>
                                        <td>{{ $score->kcxh }}</td>
                                        <td>{{ is_null($score->task) ? '' : $score->task->course->kcmc }}</td>
                                        <td>{{ $score->platform->mc }}</td>
                                        <td>{{ $score->property->mc }}</td>
                                        @foreach (array_pluck($values, 'id') as $id)
                                        	<td{!! $score->{'cj' . $id} < config('constants.score.passline') ? ' class="danger"' : '' !!}>{{ $score->{'cj' . $id} }}</td>
                                        @endforeach
                                        <td{!! $score->zpcj < config('constants.score.passline') ? ' class="danger"' : '' !!}>{{ $score->zpcj }}</td>
                                        <td>{{ $score->mode->mc }}</td>
                                        <td>{{ $score->exstatus->mc }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endforeach
    @endif
@stop