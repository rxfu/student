@extends('app')

@section('content')
<form id="xfzhForm" name="xfzhForm" method="post" action="{{ url('xfzh/store') }}" class="form-horizontal">
    {!! csrf_field() !!}
    <section class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">待转换课程</div>
                </div>
                <div class="panel-body">
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
                                                    <input type="checkbox" name="xnqkch[]" value="{{ $course->kch }}" placeholder="前课程号">
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
                                @foreach (range(1, 5) as $number)
                                    <p class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <div class="form-inline">
                                                <div class="form-group">
                                                    <label class="control-label">课程{{ $number }}</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">课程名称</span>
                                                        <input type="text" class="form-control" name="xwqkcmc[]" placeholder="课程名称">
                                                    </div>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">成绩</span>
                                                        <input type="text" class="form-control" name="xwqcj[]" placeholder="成绩">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">转换后课程</div>
                    </div>
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
        </div>
    </section>
    <div class="form-group">
        <div class="col-sm-6 col-sm-offset-5">
            <button type="submit" class="btn btn-primary">提交申请</button>
        </div>
    </div>
</form>
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

    $('input[name="xnqkch[]"]').click(function() {
        var checked = $('input[name="xnqkch[]"]:checked');

        if (checked.length != 0) {
            $('input[name="xwqkcmc[]"]').prop('disabled', true);
            $('input[name="xwqcj[]"]').prop('disabled', true);
        } else {
            $('input[name="xwqkcmc[]"]').prop('disabled', false);
            $('input[name="xwqcj[]"]').prop('disabled', false);
        }
    });

    $('input[name="xwqkcmc[]"], input[name="xwqcj[]"]').change(function() {
        var disabled = false;

        $('input[name="xwqkcmc[]"], input[name="xwqcj[]"]').each(function() {
            if ($(this).val().trim() != '') {
                disabled = true;
            }
        });

        $('input[name="xnqkch[]"]').prop('disabled', disabled);
    });
});
</script>
@endpush