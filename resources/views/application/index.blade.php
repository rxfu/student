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
                                <th class="active">申请类型</th>
                                <th class="active">申请单号</th>
                                <th class="active">申请时间</th>
                                <th class="active">年度</th>
                                <th class="active">学期</th>
                                <th class="active">课程序号</th>
                                <th class="active">课程名称</th>
                                <th class="active">开课年级</th>
                                <th class="active">开课学院</th>
                                <th class="active">开课专业</th>
                                <th class="active">学分</th>
                                <th class="active">原年度</th>
                                <th class="active">原学期</th>
                                <th class="active">原课程序号</th>
                                <th class="active">原课程名称</th>
                                <th class="active">原学分</th>
                                <th class="active">申请类型</th>
                                <th class="active">审核意见</th>
                                <th class="active">申请状态</th>
                                <th class="active">申请退课单号</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($apps as $app)
                            <tr
                            @if (!is_null($app->tkid))
                                class="danger"
                            @endif>
                                <td>
                                    @if ($allowed_apply)
                                        @if (0 == $app->sh)
                                    		<form id="deleteForm" name="deleteForm" action="{{ route('application.destroy', $app->id) }}" method="post" role="form">
                                    			{!! method_field('delete') !!}
                                    			{!! csrf_field() !!}
                                                <input type="hidden" name="xklx" value="{{ $app->xklx }}">
                                                <input type="hidden" name="sh" value="{{ $app->sh }}">
                                    			<button type="submit" class="btn btn-danger">撤销申请</button>
                                    		</form>
                                        @elseif (2 == $app->sh)
                                            {{ config('constants.application.audit.' . $app->sh) }}
                                        @elseif (1 == $app->sh)
                                            @if (App\Models\Application::whereTkid($app->id)->whereSh('0')->exists())
                                                已申请退课
                                            @elseif (App\Models\Application::whereTkid($app->id)->whereSh('1')->exists())
                                                已退课
                                            @elseif (is_null($app->tkid))
                                                <form id="createForm" name="createForm" action="{{ route('application.store') }}" method="post" role="form">
                                                    {!! csrf_field() !!}
                                                    <input type="hidden" name="tkid" value="{{ $app->id }}">
                                                    <button type="submit" class="btn btn-success">申请退课</button>
                                                </form>
                                            @else
                                                {{ config('constants.application.audit.' . $app->sh) }}
                                            @endif
                                    	@endif
                                    @else
                                        非选课申请时间，不允许申请选课或退课
                                    @endif
                                </td>
                                <td>
                                    @if (is_null($app->tkid))
                                        选课申请
                                    @else
                                        退课申请
                                    @endif
                                </td>
                                <td>{{ $app->id }}</td>
                                <td>{{ $app->xksj }}</td>
                                <td>{{ $app->nd }}</td>
                                <td>{{ $app->term->mc }}</td>
                                <td>{{ $app->kcxh }}</td>
                                <td>{{ $app->kcmc }}</td>
                                <td>{{ $app->nj }}</td>
                                <td>{{ optional($app->college)->mc }}</td>
                                <td>{{ optional($app->major)->mc }}</td>
                                <td>{{ $app->xf }}</td>
                                <td>{{ $app->ynd }}</td>
                                <td>{{ is_null($app->oterm) ? '' : $app->oterm->mc }}</td>
                                <td>{{ $app->ykcxh }}</td>
                                <td>{{ $app->ykcmc }}</td>
                                <td>{{ $app->yxf }}</td>
                                <td>{{ config('constants.application.type.' . $app->xklx) }}</td>
                                <td>{{ $app->shyj }}</td>
                                <td>{{ config('constants.application.audit.' . $app->sh) }}</td>
                                <td>{{ $app->tkid }}</td>
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