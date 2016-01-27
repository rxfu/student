@extends('app')

@section('content')
<section class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover data-table">
                        <thead>
                            <tr>
                                <th class="active">年度</th>
                                <th class="active">学期</th>
                                <th class="active">课程代码</th>
                                <th class="active">课程名称</th>
                                <th class="active">成绩</th>
                                <th class="active">学分</th>
                                <th class="active">绩点</th>
                                <th class="active">课程平台</th>
                                <th class="active">课程性质</th>
                                <th class="active">考核方式</th>
                                <th class="active">考试状态</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($scores as $score)
                            <tr>
                                <td>{{ $score->nd }}</td>
                                <td>{{ $score->term->mc }}</td>
                                <td><a href="{{ url('score', $score->kch) }}">{{ $score->kch }}</a></td>
                                <td>{{ $score->course->kcmc }}</td>
                                <td{{ $score->cj > config('constants.score.passline') ? '' : ' class="danger"' }}>{{ $score->cj }}</td>
                                <td>{{ $score->xf }}</td>
                                <td>{{ $score->jd }}</td>
                                <td>{{ $score->platform->mc }}</td>
                                <td>{{ $score->property->mc }}</td>
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
@stop