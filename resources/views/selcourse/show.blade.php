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
                                <th class="active">考核方式</th>
                                <th class="active">上课人数</th>
                                <th class="active">已选人数</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($courses as $course)
                            	<tr>
                            		<td>选课</td>
                            		<td>{{ $course->kcxh }}</td>
                            		<td>{{ $course->kch }}</td>
                            		<td>{{ $course->zxf }}</td>
                            		<td>{{ $course->kh }}</td>
                            		<td>{{ $course->zrs }}</td>
                            		<td>{{ $course->rs }}</td>
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