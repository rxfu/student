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
                                <th class="active">操作</th>
                                <th class="active">申请时间</th>
                                <th class="active">年度</th>
                                <th class="active">学期</th>
                                <th class="active">课程序号</th>
                                <th class="active">课程名称</th>
                                <th class="active">学分</th>
                                <th class="active">原年度</th>
                                <th class="active">原学期</th>
                                <th class="active">原课程序号</th>
                                <th class="active">原课程名称</th>
                                <th class="active">原学分</th>
                                <th class="active">申请类型</th>
                                <th class="active">审核意见</th>
                                <th class="active">申请状态</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($apps as $app)
                            <tr>
                                <td>
                                	@if (1 != $app->sh)
                                		<form id="deleteForm" name="deleteForm" action="{{ route('application.destroy', $app->kcxh) }}" method="post" role="form">
                                			{!! method_field('delete') !!}
                                			{!! csrf_field() !!}
                                			<button type="submit" class="btn btn-danger">撤销申请</button>
                                		</form>
                                	@endif
                                </td>
                                <td>{{ $app->xksj }}</td>
                                <td>{{ $app->nd }}</td>
                                <td>{{ $app->term->mc }}</td>
                                <td>{{ $app->kcxh }}</td>
                                <td>{{ App\Models\Course::find(App\Http\Helper::getCno($app->kcxh))->kcmc }}</td>
                                <td>{{ $app->xf }}</td>
                                <td>{{ $app->ynd }}</td>
                                <td>{{ count($app->oterm) ? $app->oterm->mc : '' }}</td>
                                <td>{{ $app->ykcxh }}</td>
                                <td>{{ App\Models\Course::find(App\Http\Helper::getCno($app->ykcxh))->kcmc }}</td>
                                <td>{{ $app->yxf }}</td>
                                <td>{{ config('constants.application.type.' . $app->xklx) }}</td>
                                <td>{{ $app->shyj }}</td>
                                <td>{{ config('constants.application.audit.' . $app->sh) }}</td>
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