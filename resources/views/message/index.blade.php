@extends('app')

@section('content')
<section class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="messages-table" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="active">发送者</th>
                                <th class="active">内容</th>
                                <th class="active">发送时间</th>
                                <th class="active">状态</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>发送者</th>
                                <th>内容</th>
                                <th>发送时间</th>
                                <th>状态</th>
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
    $('#messages-table').dataTable({
        'ajax': '{!! url('message/listing') !!}',
        'columns': [
            { data: 'xxfsz', name: 'xxfsz' },
            { data: 'xxnr', name: 'xxnr' },
            { data: 'fssj', name: 'fssj' },
            { data: 'ydbz', name: 'ydbz' }
        ]
    });
});
</script>
@endpush