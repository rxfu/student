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
                                <th class="active">课程号</th>
                                <th class="active">课程名称</th>
                                <th class="active">课程英文名称</th>
                                <th class="active">课程平台</th>
                                <th class="active">课程性质</th>
                                <th class="active">学时</th>
                                <th class="active">学分</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($courses as $course)
                            <tr>
                                <td>{{ $course->task->kch }}</td>
                                <td>{{ $course->task->course->kcmc }}</td>
                                <td>{{ $course->task->course->kcywmc }}</td>
                                <td>{{ $course->platform->mc }}</td>
                                <td>{{ $course->property->mc }}</td>
                                <td>{{ $course->plan->llxs + $course->plan->syxs }}</td>
                                <td>{{ $course->plan->zxf }}</td>
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