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
                            <th colspan="2" class="warning text-center">应修学分</th>
                            <th colspan="2" class="success text-center">已获得学分</th>
                            <th colspan="2" class="danger text-center">未获得学分</th>
                            <th colspan="2" class="info text-center">本学期在修学分</th>
                            <th colspan="2" class="primary text-center">已选课总学分<br>（不包含重修课学分）</th>
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
                                    <td class="primary text-center">{{ isset($credit['unretake']) ? $credit['unretake'] : 0 }}</td>
                                    @if ($credit == reset($items))
                                        <td rowspan="{{ count($items) }}" class="primary text-center">{{ array_sum(array_pluck($items, 'unretake')) }}</td>
                                    @endif
                                </tr>
                            @endforeach
                        @endforeach
                        <tr>
                            <th colspan="2" class="active text-center">总学分</th>
                            <td colspan="2" class="warning text-center">{{ array_sum(array_column($credits['B'] ?? [], 'graduation')) + array_sum(array_column($credits['X'] ?? [], 'graduation'))  }}</td>
                            <td colspan="2" class="success text-center">{{ array_sum(array_column($credits['B'] ?? [], 'studied')) + array_sum(array_column($credits['X'] ?? [], 'studied')) + array_sum(array_column($credits['O'] ?? [], 'studied')) }}</td>
                            <td colspan="2" class="danger text-center">{{ max(array_sum(array_column($credits['B'] ?? [], 'graduation')) + array_sum(array_column($credits['X'] ?? [], 'graduation')) - array_sum(array_column($credits['B'] ?? [], 'studied')) - array_sum(array_column($credits['X'] ?? [], 'studied')), 0) }}</td>
                            <td colspan="2" class="info text-center">{{ array_sum(array_column($credits['B'] ?? [], 'selected')) + array_sum(array_column($credits['X'] ?? [], 'selected')) + array_sum(array_column($credits['O'] ?? [], 'selected')) }}</td>
                            <td colspan="2" class="primary text-center">{{ array_sum(array_column($credits['B'] ?? [], 'unretake')) + array_sum(array_column($credits['X'] ?? [], 'unretake')) + array_sum(array_column($credits['O'] ?? [], 'unretake')) }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="panel-foot">
                <ul>
                    <li>毕业审核：<span class="text-danger"><strong>根据各类别课程应修学分</strong></span>要求，按已获得学分进行审核。</li>
                    <li>毕业学费结算：<span class="text-danger"><strong>根据已选课总学分</strong></span>进行学费结算。</li>
                </ul>
            </div>
        </div>
    </div>
</section>
@stop