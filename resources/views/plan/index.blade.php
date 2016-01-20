@extends('app')

@section('content')
<section class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">{{ Auth::user()->profile->college->mc . Auth::user()->profile->nj }}级{{ Auth::user()->profile->major->mc }}专业课程设置计划总表</div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover data-table">
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
                                <th class="active">学时数</th>
                                <th class="active">理论讲授学时</th>
                                <th class="active">实验实训学时</th>
                                <th class="active">开课学期</th>
                                <th class="active">考核方式</th>
                                <th class="active">开课单位</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($plans as $plan)
                            <tr>
                                <th class="active">{{ $plan->platform->mc }}</th>
                                <th class="active">{{ $plan->property->mc }}</th>
                                <td>{{ $plan->kch }}</td>
                                <td>{{ $plan->course->kcmc }}</td>
                                <td>{{ $plan->course->kcywmc }}</td>
                                <td>{{ $plan->zxf }}</td>
                                <td>{{ $plan->llxf }}</td>
                                <td>{{ $plan->syxf }}</td>
                                <td>{{ $plan->llxs + $plan->syxs }}</td>
                                <td>{{ $plan->llxs }}</td>
                                <td>{{ $plan->syxs }}</td>
                                <td>{{ $plan->kxq }}</td>
                                <td>{{ $plan->mode->mc }}</td>
                                <td>{{ $plan->college->mc }}</td>
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