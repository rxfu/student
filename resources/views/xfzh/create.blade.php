@extends('app')

@section('content')
<section class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <form id="xfzhForm" name="xfzhForm" method="post" action="{{ url('xfzh/store') }}" class="form-horizontal">
                	{!! csrf_field() !!}
                    <h2>待转换课程</h2>
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
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <th class="active"></th>
                                            <th class="active">课程号</th>
                                            <th class="active">课程名称</th>
                                            <th class="active">平台</th>
                                            <th class="active">性质</th>
                                            <th class="active">学分</th>
                                            <th class="active">成绩</th>
                                        </tr>

                                        @foreach ($studied_courses as $course)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="qkch[]" value="{{ $course->kch }}" placeholder="前课程号">
                                                </td>
                                                <td>{{ $course->kch }}</td>
                                                <td>{{ $course->course->kcmc }}</td>
                                                <td>{{ $course->platform->mc }}</td>
                                                <td>{{ $course->property->mc }}</td>
                                                <td>{{ $course->xf }}</td>
                                                <td>{{ $course->cj }}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="out-school">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <span class="input-group-addon">课程名称</span>
                                            <input type="text" class="form-control" name="qkcmc[]" placeholder="课程名称">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <span class="input-group-addon">成绩</span>
                                            <input type="text" class="form-control" name="qcj[]" placeholder="成绩">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h2>转换后课程</h2>
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th class="active"></th>
                                    <th class="active">课程号</th>
                                    <th class="active">课程名称</th>
                                    <th class="active">平台</th>
                                    <th class="active">性质</th>
                                </tr>

                                @foreach ($courses as $course)
                                    <tr>
                                        <td>
                                            <input type="radio" name="kch" value="{{ $course->kch }}" placeholder="课程号">
                                        </td>
                                        <td>{{ $course->kch }}</td>
                                        <td>{{ $course->course->kcmc }}</td>
                                        <td>{{ $course->platform->mc }}</td>
                                        <td>{{ $course->property->mc }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6 col-sm-offset-5">
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