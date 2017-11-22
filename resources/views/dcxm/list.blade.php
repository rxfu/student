@extends('app')

@section('content')
<section class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">项目申请列表</div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="active">项目编号</th>
                                <th class="active">项目名称</th>
                                <th class="active">项目类别</th>
                                <th class="active">所属学科</th>
                                <th class="active">申请时间</th>
                                <th class="active">审核状态</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projects as $project)
                            <tr>
                            	<td>{{ $projct->xmbh }}</td>
                                <td>{{ $project->xmmc }}</td>
                                <td>{{ $project->category->mc }}</td>
                                <td>{{ $project->subject->mc }}</td>
                                <td>{{ $project->cjsj }}</td>
                            	<td>
                                    @if ($project->sfsh)
                                        @if ($project->sftg)
                                            审核已通过
                                        @else
                                            审核未通过
                                        @endif
                                    @else
                                        未审核
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-md-2 col-md-offset-5">
                        <a href="{{ url('dcxm/xmxx') }}" title="项目申请" role="button" class="btn btn-lg btn-primary btn-block">申请新项目</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop