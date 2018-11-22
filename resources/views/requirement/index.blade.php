@extends('app')

@section('content')
<section class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th colspan="2" class="active text-center">课程平台与性质</th>
                            <th colspan="2" class="warning text-center">应修读学分数</th>
                            <th colspan="2" class="success text-center">已获得学分数</th>
                            <th colspan="2" class="danger text-center">未获得学分数</th>
                            <th colspan="2" class="info text-center">本次选修学分数</th>
                        </tr>
                        @foreach ($credits as $property => $items)
                            @foreach ($items as $key => $credit)
                                <tr>
                                    @if ($credit == reset($items))
                                        <th rowspan="{{ count($items) }}" class="active text-center">
                                            @if ('B' == $property)
                                                必修学分数
                                            @elseif ('X' == $property)
                                                选修学分数
                                            @else
                                                计划外学分
                                            @endif
                                        </th>
                                    @endif
                                    <th class="active text-center">{{ $credit['title'] }}</th>
                                    <td class="warning text-center">{{ $credit['graduation'] }}</td>
                                    @if ($credit == reset($items))
                                        <td rowspan="{{ count($items) }}" class="warning text-center">{{ array_sum(array_pluck($items, 'graduation')) }}</td>
                                    @endif
                                    <td class="success text-center">{{ isset($credit['studied']) ? $credit['studied'] : 0 }}</td>
                                    @if ($credit == reset($items))
                                        <td rowspan="{{ count($items) }}" class="success text-center">{{ array_sum(array_pluck($items, 'studied')) }}</td>
                                    @endif
                                    <td class="danger text-center">{{ isset($credit['studied']) ? max($credit['graduation'] - $credit['studied'], 0) : $credit['graduation'] }}</td>
                                    @if ($credit == reset($items))
                                        <td rowspan="{{ count($items) }}" class="danger text-center">{{ max(array_sum(array_pluck($items, 'graduation')) - array_sum(array_pluck($items, 'studied')), 0) }}</td>
                                    @endif
                                    <td class="info text-center">{{ isset($credit['selected']) ? $credit['selected'] : 0 }}</td>
                                    @if ($credit == reset($items))
                                        <td rowspan="{{ count($items) }}" class="info text-center">{{ array_sum(array_pluck($items, 'selected')) }}</td>
                                    @endif
                                </tr>
                            @endforeach
                        @endforeach
                        <tr>
                            <th colspan="2" class="active text-center">总学分</th>
                            <td colspan="2" class="warning text-center">{{ array_sum(array_column($credits['B'], 'graduation')) + array_sum(array_column($credits['X'], 'graduation'))  }}</td>
                            <td colspan="2" class="success text-center">{{ array_sum(array_column($credits['B'], 'studied')) + array_sum(array_column($credits['X'], 'studied'))  }}</td>
                            <td colspan="2" class="danger text-center">{{ array_sum(array_column($credits['B'], 'graduation')) + array_sum(array_column($credits['X'], 'graduation')) - array_sum(array_column($credits['B'], 'studied')) - array_sum(array_column($credits['X'], 'studied')) }}</td>
                            <td colspan="2" class="info text-center">{{ array_sum(array_column($credits['B'], 'selected')) + array_sum(array_column($credits['X'], 'selected')) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@stop