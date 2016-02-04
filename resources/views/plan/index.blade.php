@extends('app')

@section('content')
<section class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">{{ Auth::user()->profile->college->mc . Auth::user()->profile->nj }}级{{ Auth::user()->profile->major->mc }}专业课程设置计划总表</div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="plans-table" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="active">课程平台</th>
                                <th class="active">课程性质</th>
                                <th class="active">课程代码</th>
                                <th class="active">课程中文名称</th>
                                <th class="active">课程英文名称</th>
                                <th class="active">总学分</th>
                                <th class="active">理论讲授学分</th>
                                <th class="active">实验实训学分</th>
                                <th class="active">总学时</th>
                                <th class="active">理论讲授学时</th>
                                <th class="active">实验实训学时</th>
                                <th class="active">开课学期</th>
                                <th class="active">考核方式</th>
                                <th class="active">开课单位</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>课程平台</th>
                                <th>课程性质</th>
                                <th>课程代码</th>
                                <th>课程中文名称</th>
                                <th>课程英文名称</th>
                                <th>总学分</th>
                                <th>理论讲授学分</th>
                                <th>实验实训学分</th>
                                <th>总学时</th>
                                <th>理论讲授学时</th>
                                <th>实验实训学时</th>
                                <th>开课学期</th>
                                <th>考核方式</th>
                                <th>开课单位</th>
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
    $('#plans-table').dataTable({
        ajax: '{!! url('plan/listing') !!}',
        columns: [
            { data: 'pt', name: 'pt'},
            { data: 'xz', name: 'xz'},
            { data: 'kch', name: 'kch'},
            { data: 'kcmc', name: 'kcmc'},
            { data: 'kcywmc', name: 'kcywmc'},
            { data: 'zxf', name: 'zxf'},
            { data: 'llxf', name: 'llxf'},
            { data: 'syxf', name: 'syxf'},
            { data: 'zxs', name: 'zxs'},
            { data: 'llxs', name: 'llxs'},
            { data: 'syxs', name: 'syxs'},
            { data: 'kxq', name: 'kxq'},
            { data: 'kh', name: 'kh'},
            { data: 'kkxy', name: 'kkxy'}
        ]
    });
})
</script>
@endpush