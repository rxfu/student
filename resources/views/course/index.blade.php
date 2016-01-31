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
                                <th class="active">课程简介</th>
                                <th class="active">使用教材</th>
                            </tr>
                        </thead>
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
    $('#courses-table').DataTable({
        processing: true,
        serverSide: true,
        language: {
            url: './js/plugins/dataTables/i18n/zh_cn.lang'
        },
        ajax: '{!! url('course/listing') !!}',
        columns: [
            { data: 'kch', name: 'kch' },
            { data: 'kcmc', name: 'kcmc' },
            { data: 'kcywmc', name: 'kcywmc' },
            { data: 'xf', name: 'xf' },
            { data: 'xs', name: 'xs' },
            { data: 'jj', name: 'jj' },
            { data: 'jc', name: 'jc' },
        ]
    });
});
</script>
@endpush