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
                                <th class="active">序号</th>
                                <th class="active">课程号</th>
                                <th class="active">课程名称</th>
                                <th class="active">课程平台</th>
                                <th class="active">课程性质</th>
                                <th class="warning active">计划学分</th>
                                <th class="info active">选课学分</th>
                                <th class="success active">成绩学分</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0?>
                            @foreach ($credits as $credit)
                                <tr>
                                    <td><i>#{{ ++$i }}</i></td>
                                    <td>{{ $credit['kch'] }}</td>
                                    <td>{{ $credit['kcmc'] }}</td>
                                    <td>{{ $credit['pt'] }}</td>
                                    <td>{{ $credit['xz'] }}</td>
                                    <td class="warning">{{ $credit['plan_credit'] }}</td>
                                    <td class="info">{{ $credit['selected_credit'] }}</td>
                                    <td class="success">{{ $credit['score_credit'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="5">学分合计</th>
                                <th class="warning">{{ $plan_total }}</th>
                                <th class="info">{{ $selected_total }}</th>
                                <th class="success">{{ $score_total }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@stop