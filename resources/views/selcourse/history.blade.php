@extends('app')

@section('content')
<section class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="active">学年度</th>
                                <th class="active">学期</th>
                                <th class="active">课程代码</th>
                                <th class="active">课程名称</th>
                                <th class="active">学分</th>
                                <th class="active">上课时间</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>学年度</th>
                                <th>学期</th>
                                <th>课程代码</th>
                                <th>课程名称</th>
                                <th>学分</th>
                                <th>上课时间</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($courses as $course)
                                <tr>
                                    <td>{{ $course['nd'] }}</td>
                                    <td>{{ $course['xq'] }}</td>
                                	<td>{{ $course['kcxh'] }}</td>
                                	<td>{{ $course['kcmc'] }}</td>
                                	<td>{{ $course['xf'] }}</td>
                                    <td>
                                        @foreach ($course['sj'] as $class)
                                            第 {{ $class['ksz'] === $class['jsz'] ? $class['ksz'] : $class['ksz'] . ' ~ ' . $class['jsz'] }} 周星期{{ config('constants.week.' . $class['week']) }}第 {{ $class['ksj'] === $class['jsj'] ? $class['ksj'] : $class['ksj'] . ' ~ ' . $class['jsj'] }} 节
                                            @if ($loop->last)
                                                @break
                                            @endif
                                            <br>
                                        @endforeach
                                    </td>
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