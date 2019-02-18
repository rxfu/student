@extends('app')

@section('content')
<section class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <form id="xfzhForm" name="xfzhForm" method="post" action="{{ url('xfzh/store') }}" class="form-horizontal">
                	{!! csrf_field() !!}
                    <h2>转换前课程</h2>
                    <div role="tabpanel">
                        <ul id="xfzh-tab" class="nav nav-pills" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#in-school" aria-controls="in-school" role="tab" data-toggle="pill">校内课程转换</a>
                            </li>
                            <li role="presentation">
                                <a href="#out-school" aria-controls="out-school" role="tab" data-toggle="pill">校外课程转换</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="in-school">
                                <div class="form-group">
                                    <label for="qkch" class="col-sm-2 control-label">课程号</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="qkch" name="qkch" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="qkcmc" class="col-sm-2 control-label">课程名称</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="qkcmc" name="qkcmc" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="qpt" class="col-sm-2 control-label">课程平台</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="qpt" name="qpt" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="qxz" class="col-sm-2 control-label">课程性质</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="qxz" name="qxz" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="qxs" class="col-sm-2 control-label">学时</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="qxs" name="qxs" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="qxf" class="col-sm-2 control-label">学分</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="qxf" name="qxf" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="qcj" class="col-sm-2 control-label">成绩</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="qcj" name="qcj" readonly>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="out-school">
                                <div class="form-group">
                                    <label for="qkcmc" class="col-sm-2 control-label">课程名称</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="qkcmc" name="qkcmc">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="qcj" class="col-sm-2 control-label">成绩</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="qcj" name="qcj">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h2>转换后课程</h2>
                    <div class="row">
                        <div class="col-sm-6">
                            <select name="kch" class="form-control">
                                @foreach ($courses as $course)
                                    <option value="{{ $course->kch }}">{{ $course->course->kcmc }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="kch" class="col-sm-2 control-label">课程号</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="kch" name="kch" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="kcmc" class="col-sm-2 control-label">课程名称</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="kcmc" name="kcmc" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pt" class="col-sm-2 control-label">课程平台</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="pt" name="pt" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="xz" class="col-sm-2 control-label">课程性质</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="xz" name="xz" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6 col-sm-offset-2">
                            <button type="submit" class="btn btn-primary">提交申请</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@stop

@push('styles')
<style>
.tab-content {
    padding-top: 15px;
}
</style>
@endpush

@push('scripts')
<script>
$(function() {
    $('#xfzh-tab a').click(function(e) {
        e.preventDefault();
        $(this).tab('show');
    });
/*
    $('#ynd').val($('#ykcxh option:selected').attr('data-ynd'));
    $('#yxq').val($('#ykcxh option:selected').attr('data-yxq'));
    $('#yxqmc').val($('#ykcxh option:selected').attr('data-yxqmc'));
    $('#yxf').val($('#ykcxh option:selected').attr('data-yxf'));

    $('#ykcxh').change(function() {
        $('#ynd').val($('#ykcxh option:selected').attr('data-ynd'));
        $('#yxq').val($('#ykcxh option:selected').attr('data-yxq'));
        $('#yxqmc').val($('#ykcxh option:selected').attr('data-yxqmc'));
        $('#yxf').val($('#ykcxh option:selected').attr('data-yxf'));
    });*/
});
</script>
@endpush