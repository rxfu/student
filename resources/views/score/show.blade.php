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
                                <th class="active">年度</th>
                                <th class="active">学期</th>
                                <th class="active">课程代码</th>
                                <th class="active">课程名称</th>
                                <th class="active">课程英文名称</th>
                                <th class="active">课程平台</th>
                                <th class="active">课程性质</th>
                                <th class="active">总评成绩</th>
                                <th class="active">考核方式</th>
                                <th class="active">考试状态</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($scores as $score)
                            <tr>
                                <td>{{ $score->nd }}</td>
                                <td>{{ $score->xq }}</td>
                                <td>{{ $score->kcxh }}</td>
                                <td>{{ $score->kcmc }}</td>
                                <td>{{ $score->kcywmc }}</td>
                                <td>{{ $score->pt }}</td>
                                <td>{{ $score->xz }}</td>
                                <td>{{ $score->zpcj }}</td>
                                <td>{{ $score->kh }}</td>
                                <td>{{ $score->kszt }}</td>
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