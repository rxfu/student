@extends('app')

@section('content')
<section class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="active" rowspan="2" valign="middle">操作</th>
                                <th class="active" rowspan="2">申请时间</th>
                                <th class="active" colspan="6">转换前</th>
                                <th class="active" colspan="6">转换后</th>
                                <th class="active" rowspan="2">审核意见</th>
                                <th class="active" rowspan="2">申请状态</th>
                            </tr>
                            <tr>
                                <th class="active">课程号</th>
                                <th class="active">课程名称</th>
                                <th class="active">课程平台</th>
                                <th class="active">课程性质</th>
                                <th class="active">学分</th>
                                <th class="active">成绩</th>
                                <th class="active">课程号</th>
                                <th class="active">课程名称</th>
                                <th class="active">课程平台</th>
                                <th class="active">课程性质</th>
                                <th class="active">学分</th>
                                <th class="active">成绩</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                            <tr>
                                <td>
                                	@if (0 == $item->zt)
                                		<form id="deleteForm" name="deleteForm" action="{{ url('xfzh/delete', $item->id) }}" method="post" role="form">
                                			{!! method_field('delete') !!}
                                			{!! csrf_field() !!}
                                			<button type="submit" class="btn btn-danger">撤销申请</button>
                                		</form>
                                	@endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@stop

@push('styles')
<style>
    table th {
        text-align: center;
        vertical-align: middle !important;
    }
</style>
@endpush