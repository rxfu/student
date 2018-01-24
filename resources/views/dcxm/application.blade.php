@extends('app')

@section('content')
<form id="appForm" name="appForm" method="post" action="{{ url('dcxm/xmsq/' . $project->id) }}" class="form-horizontal" enctype="multipart/form-data">
    {!! csrf_field() !!}
    <section class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">项目申报书</div>
                </div>
                <div class="panel-body">
                    <label for="xmjj" class="control-label">
                        <h3>一、项目简介（200字左右）</h3>
                    </label>
                    <div>
                        <textarea id="xmjj" name="xmjj" class="form-control note" rows="20">{{ count($project->application) ? $project->application->xmjj : '' }}</textarea>
                    </div>

                    <label for="sqly" class="control-label">
                        <h3>二、申请理由（包括自身/团队具备的知识、条件、特长、兴趣、已有的成果、前期准备、项目研究的国内外研究现状和发展动态等）</h3>
                    </label>
                    <div>
                        <textarea id="sqly" name="sqly" class="form-control note" rows="20">{{ count($project->application) ? $project->application->sqly : '' }}</textarea>
                    </div>

                    <label for="xmfa" class="control-label">
                        <h3>三、项目方案（包括项目研究的目标和主要内容、拟解决的途径、人员分工、预期成果等，创业类项目还需包括市场分析、营销模式、管理模式、财务分析、风险预期等内容）</h3>
                    </label>
                    <div>
                        <textarea id="xmfa" name="xmfa" class="form-control note" rows="20">{{ count($project->application) ? $project->application->xmfa : '' }}</textarea>
                    </div>

                    <label for="tscx" class="control-label">
                        <h3>四、简述特色与创新点</h3>
                    </label>
                    <div>
                        <textarea id="tscx" name="tscx" class="form-control note" rows="20">{{ count($project->application) ? $project->application->tscx : '' }}</textarea>
                    </div>

                    <label for="jdap" class="control-label">
                        <h3>五、项目进度安排（包括详细的计划安排）</h3>
                    </label>
                    <div>
                        <textarea id="jdap" name="jdap" class="form-control note" rows="20">{{ count($project->application) ? $project->application->jdap : '' }}</textarea>
                    </div>

                    <label for="zmcl" class="control-label">
                        <h3>项目证明材料</h3>
                    </label>
                    <div>
                        <input type="file" name="zmcl" id="zmcl" placeholder="项目证明材料" class="form-control">
                        @if (count($project->application) && (!empty($project->application->zmcl)))
                        <p class="help-block">
                            <a href="{{ url('dcxm/zmcl', $project->id) }}" title="项目证明材料">下载项目证明材料</a>
                        </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="form-group">
        <div class="col-sm-2 col-sm-offset-5">
            <button type="submit" class="btn btn-primary btn-block btn-lg">下一步</button>
        </div>
    </div>
</form>
@stop

@push('styles')
<link rel="stylesheet" href="{{ asset('summernote/summernote.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('summernote/summernote.js') }}"></script>
<script src="{{ asset('summernote/lang/summernote-zh-CN.js') }}"></script>
<script>
$(function() {
    $('.note').summernote({
        lang: 'zh-CN',
        height: 400
    });
})
</script>
@endpush