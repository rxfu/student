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
                                <th class="active">课程号</th>
                                <th class="active">课程名称</th>
                                <th class="warning active">计划学分</th>
                                <th class="info active">选课学分</th>
                                <th class="active">成绩学分</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($credits as $credit)
                                <tr>
                                    <td>{{ $credit['kch'] }}</td>
                                    <td>{{ $credit['kcmc'] }}</td>
                                    <td class="warning">{{ $credit['plan_credit'] }}</td>
                                    <td class="info">{{ $credit['selected_credit'] }}</td>
                                    <td>{{ $credit['score_credit'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2">学分合计</th>
                                <th class="warning">{{ $plan_total }}</th>
                                <th class="info">{{ $selected_total }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@stop