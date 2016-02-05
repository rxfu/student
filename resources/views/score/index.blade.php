@extends('app')

@section('content')
<section class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="table-responsive">
                    <table id='scores-table' class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="active">年度</th>
                                <th class="active">学期</th>
                                <th class="active">课程代码</th>
                                <th class="active">课程名称</th>
                                <th class="active">成绩</th>
                                <th class="active">学分</th>
                                <th class="active">绩点</th>
                                <th class="active">课程平台</th>
                                <th class="active">课程性质</th>
                                <th class="active">考核方式</th>
                                <th class="active">考试状态</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>年度</th>
                                <th>学期</th>
                                <th>课程代码</th>
                                <th>课程名称</th>
                                <th>成绩</th>
                                <th>学分</th>
                                <th>绩点</th>
                                <th>课程平台</th>
                                <th>课程性质</th>
                                <th>考核方式</th>
                                <th>考试状态</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@stop

@push('scripts')
<script>
$(function() {
    $('#scores-table').dataTable({
        'searching': false,
        'ajax': '{!! url('score/listing') !!}',
        'columns': [
            { data: 'nd', name: 'nd'},
            { data: 'term.mc', name: 'xq'},
            { data: 'kch', name: 'kch'},
            { data: 'kcmc', name: 'kcmc'},
            { data: 'cj', name: 'cj'},
            { data: 'xf', name: 'xf'},
            { data: 'jd', name: 'jd'},
            { data: 'platform.mc', name: 'pt'},
            { data: 'property.mc', name: 'xz'},
            { data: 'mode.mc', name: 'kh'},
            { data: 'exstatus.mc', name: 'zt'},
        ]
    });
});
</script>
@endpush