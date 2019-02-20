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
                                <th class="active">导师意见</th>
                                <th class="active">学院意见</th>
                                <th class="active">学校意见</th>
                                <th class="active">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projects as $project)
                            <tr>
                            	<td>{{ $project->xmbh }}</td>
                                <td>{{ $project->xmmc }}</td>
                                <td>{{ $project->category->mc }}</td>
                                <td>{{ $project->subject->mc }}</td>
                                <td>{{ date('Y-m-d', strtotime($project->cjsj)) }}</td>
                                <td>{{ is_null($project->jssfty) ? '' : ($project->jssfty ? '同意' : '不同意') }}</td>
                                <td>{{ is_null($project->xysfty) ? '' : ($project->xysfty ? '同意' : '不同意') }}</td>
                                <td>{{ is_null($project->xxsfty) ? '' : ($project->xxsfty ? '同意' : '不同意') }}</td>
                                <td>
                                    @if ($project->jssfty != 1)
                                        <a href="{{ url('dcxm/xmxx/' . $project->id . '/edit') }}" title="修改项目信息" role="button" class="btn btn-primary">修改项目信息</a>
                                        <a href="{{ url('dcxm/xmsq/' . $project->id) }}" title="填写申报书" role="button" class="btn btn-success">填写申报书</a>
                                        <!--a href="#" title="填写任务书" role="button" class="btn btn-info">填写任务书</a-->
                                        <a href="#" title="删除项目" role="button" class="btn btn-danger" onclick="confirm('你确定要删除这个项目？删除这个项目后，这个项目所带有的所有信息和资料将一并删除！') ? document.getElementById('delete-{{ $project->id }}-form').submit() : false">删除项目</a>
                                        <form id="delete-{{ $project->id }}-form" method="post" action="{{ url('dcxm/xmxx/' . $project->id) }}" style="display: none">
                                            {!! method_field('delete') !!}
                                            {!! csrf_field() !!}
                                        </form>
                                    @endif
                                    @if ($editFund && ($project->xxsfty == 1))
                                        <a href="{{ url('dcxm/xmjf/' . $project->id) }}" title="修改经费" role="button" class="btn btn-info">修改经费</a>
                                    @endif
                                    @if (!is_null($project->application))
                                        <a href="{{ url('dcxm/pdf/' . $project->id) }}" title="下载申报书" role="button" class="btn btn-warning">下载申报书</a>
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