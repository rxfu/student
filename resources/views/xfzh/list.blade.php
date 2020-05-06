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
                                <th class="active" rowspan="2" valign="middle">操作</th>
                                <th class="active" rowspan="2">申请时间</th>
                                <th class="active" colspan="6">转换前</th>
                                <th class="active" colspan="6">转换后</th>
                                <th class="active" rowspan="2">申请状态</th>
                            </tr>
                            <tr>
                                <th class="active">课程号</th>
                                <th class="active">课程名称</th>
                                <th class="active">课程平台</th>
                                <th class="active">课程性质</th>
                                <th class="active">学分</th>
                                <th class="active">成绩</th>
                                <th class="active">课程号</th>
                                <th class="active">课程名称</th>
                                <th class="active">课程平台</th>
                                <th class="active">课程性质</th>
                                <th class="active">学分</th>
                                <th class="active">成绩</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                @php
                                    $rows = $item->courses->count() ? $item->courses->count() : 1;
                                @endphp
                                @foreach ($item->courses as $course)
                                    @if ($loop->first)
                                        <tr rowspan="{{ $rows }}">
                                            <td rowspan="{{ $rows }}">
                                            	@if (0 == $item->zt)
                                            		<form id="deleteForm" name="deleteForm" action="{{ url('xfzh/delete', $item->id) }}" method="post" role="form">
                                            			{!! method_field('delete') !!}
                                            			{!! csrf_field() !!}
                                            			<button type="submit" class="btn btn-danger">撤销申请</button>
                                            		</form>
                                            	@endif
                                            </td>
                                            <td rowspan="{{ $rows }}">{{ $item->sqsj }}</td>
                                    @else
                                        <tr>
                                    @endif
                                    <td>{{ $course->qkch }}</td>
                                    <td>{{ $course->qkcmc }}</td>
                                    <td>{{ is_null($course->qplatform) ? '' : $course->qplatform->mc }}</td>
                                    <td>{{ is_null($course->qproperty) ? '' : $course->qproperty->mc }}</td>
                                    <td>{{ $course->qxf }}</td>
                                    <td>{{ $course->qcj }}</td>
                                    @if ($loop->first)
                                        <td rowspan="{{ $rows }}">{{ $course->kch }}</td>
                                        <td rowspan="{{ $rows }}">{{ $course->kcmc }}</td>
                                        <td rowspan="{{ $rows }}">{{ $course->platform->mc }}</td>
                                        <td rowspan="{{ $rows }}">{{ $course->property->mc }}</td>
                                        <td rowspan="{{ $rows }}">{{ $course->xf }}</td>
                                        <td rowspan="{{ $rows }}">{{ $course->cj }}</td>
                                        <td rowspan="{{ $rows }}">
                                            @switch($item->zt)
                                                @case(0)
                                                    待审核
                                                    @break

                                                @case(1)
                                                    学院审核未通过
                                                    @break

                                                @case(2)
                                                    学院审核已通过
                                                    @break

                                                @case(3)
                                                    教务处审核未通过
                                                    @break

                                                @case(4)
                                                    教务处审核已通过
                                                    @break

                                                @default
                                                         已提交
                                            @endswitch
                                        </td>
                                    @endif
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@stop

@push('styles')
<style>
    table th {
        text-align: center;
        vertical-align: middle !important;
    }
</style>
@endpush