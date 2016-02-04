@extends('app')

@section('content')
<section class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="table-responsive">
                    <table id='courses-table' class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="active">课程代码</th>
                                <th class="active">课程名称</th>
                                <th class="active">英文名称</th>
                                <th class="active">学分</th>
                                <th class="active">学时</th>
                                <th class="active">使用教材</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>课程代码</th>
                                <th>课程名称</th>
                                <th>英文名称</th>
                                <th>学分</th>
                                <th>学时</th>
                                <th>使用教材</th>
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
    $('#courses-table').dataTable({
        'ajax': '{!! url('course/listing') !!}',
        'columns': [
            { data: 'kch', name: 'kch' },
            { data: 'kcmc', name: 'kcmc' },
            { data: 'kcywmc', name: 'kcywmc' },
            { data: 'xf', name: 'xf' },
            { data: 'xs', name: 'xs' },
            { data: 'jc', name: 'jc' },
        ]
    });
});
</script>
@endpush