@extends('app')

@section('content')
<section class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="logs-table" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="active">操作时间</th>
                                <th class="active">IP地址</th>
                                <th class="active">课程序号</th>
                                <th class="active">课程名称</th>
                                <th class="active">操作类型</th>
                                <th class="active">备注</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>操作时间</th>
                                <th>IP地址</th>
                                <th>课程序号</th>
                                <th>课程名称</th>
                                <th>操作类型</th>
                                <th>备注</th>
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
    $('#logs-table').dataTable({
        'ajax': '{!! url('log/listing') !!}',
        'columns': [
            { data: 'czsj', name: 'czsj' },
            { data: 'ip', name: 'ip' },
            { data: 'kcxh', name: 'kcxh'},
            { data: 'kcmc', name: 'kcmc'},
            { data: 'czlx', name: 'czlx' },
            { data: 'bz', name: 'bz' }
        ]
    });
});
</script>
@endpush