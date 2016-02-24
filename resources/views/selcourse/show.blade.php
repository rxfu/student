@extends('app')

@section('content')
<section class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="table-responsive tab-table">
                    <table class="table table-bordered table-striped table-hover course-table">
                        <thead>
                            <tr>
                                <th rowspan="2" class="active">操作</th>
                                <th rowspan="2" class="active">课程序号</th>
                                <th rowspan="2" class="active">课程名称</th>
                                <th rowspan="2" class="active">学分</th>
                                <th rowspan="2" class="active">考核方式</th>
                                <th colspan="3" class="active text-center">上课时间</th>
                                <th rowspan="2" class="active">所在校区</th>
                                <th rowspan="2" class="active">主要任课老师</th>
                                <th rowspan="2" class="active">上课人数</th>
                                <th rowspan="2" class="active">已选人数</th>
                            </tr>
                            <tr>
                                <th class="active">起始周次</th>
                                <th class="active">星期</th>
                                <th class="active">起始节数</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($courses as $course)
                            	<tr>
                            		<td>action</td>
                            		<td>{{ $course->kcxh }}</td>
                            		<td>{{ $course->task->course->mc }}</td>
                            		<td>{{ $course->mjcourse->plan->zxf }}</td>
                            		<td>{{ $course->mjcourse->plan->mode->mc }}</td>
                            		<td>{{ $course->ksz }} ~ {{ $course->jsz }}</td>
                            		<td>{{ $course->zc }}</td>
                            		<td>{{ $course->ksj }} ~ {{ $course->jsj }}</td>
                            		<td>{{ $course->campus->mc }}</td>
                            		<td>{{ $course->teacher->xm }}</td>
                            		<td>{{ $course->mjcourse->rs }}</td>
                            		<td>{{ $course->course->rs }}</td>
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