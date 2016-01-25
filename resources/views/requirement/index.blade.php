@extends('app')

@section('content')
<section class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th colspan="3" class="active text-center">课程平台与性质</th>
                            <th colspan="2" class="warning text-center">至少应修读学分数</th>
                            <th colspan="2" class="success text-center">已修读学分数</th>
                            <th colspan="2" class="info text-center">本次选修学分数</th>
                            <th colspan="2" class="danger text-center">未修读学分数</th>
                        </tr>
                        <tr>
                            <th rowspan="5" class="active text-center">必修学分数</th>
                            <th colspan="2" class="active text-center">通识素质教育<br>(TB)</th>
                            <td class="warning text-center">{{ $graduation['TB'] }}</td>
                            <td rowspan="5" class="warning text-center">{{ $graduation['TB'] + $graduation['KB'] + $graduation['JB'] + $graduation['SB'] + $graduation['ZB'] }}</td>
                            <td class="success text-center">{{ $studied['TB'] }}</td>
                            <td rowspan="5" class="success text-center">{{ $studied['TB'] + $studied['KB'] + $studied['JB'] + $studied['SB'] + $studied['ZB'] }}</td>
                            <td class="info text-center">{{ $selected['TB'] }}</td>
                            <td rowspan="5" class="info text-center">{{ $selected['TB'] + $selected['KB'] + $selected['JB'] + $selected['SB'] + $selected['ZB'] }}</td>
                            <td class="danger text-center">{{ $graduation['TB'] - $studied['TB'] - $selected['TB'] }}</td>
                            <td rowspan="5" class="danger text-center">{{ ($graduation['TB'] + $graduation['KB'] + $graduation['JB'] + $graduation['SB'] + $graduation['ZB']) - ($studied['TB'] + $studied['KB'] + $studied['JB'] + $studied['SB'] + $studied['ZB']) - ($selected['TB'] + $selected['KB'] + $selected['JB'] + $selected['SB'] + $selected['ZB']) }}</td>
                        </tr>
                        <tr>
                            <th colspan="2" class="active text-center">学科专业教育<br>(KB)</th>
                            <td class="warning text-center">{{ $graduation['KB'] }}</td>
                            <td class="success text-center">{{ $studied['KB'] }}</td>
                            <td class="info text-center">{{ $selected['KB'] }}</td>
                            <td class="danger text-center">{{ $graduation['KB'] - $studied['KB'] - $selected['KB'] }}</td>
                        </tr>
                        <tr>
                            <th colspan="2" class="active text-center">教师资格教育<br>(JB)</th>
                            <td class="warning text-center">{{ $graduation['JB'] }}</td>
                            <td class="success text-center">{{ $studied['JB'] }}</td>
                            <td class="info text-center">{{ $selected['JB'] }}</td>
                            <td class="danger text-center">{{ $graduation['JB'] - $studied['JB'] - $selected['JB'] }}</td>
                        </tr>
                        <tr>
                            <th colspan="2" class="active text-center">集中实践教育<br>(SB)</th>
                            <td class="warning text-center">{{ $graduation['SB'] }}</td>
                            <td class="success text-center">{{ $studied['SB'] }}</td>
                            <td class="info text-center">{{ $selected['SB'] }}</td>
                            <td class="danger text-center">{{ $graduation['SB'] - $studied['SB'] - $selected['SB'] }}</td>
                        </tr>
                        <tr>
                            <th colspan="2" class="active text-center">专业拓展教育<br>(ZB)</th>
                            <td class="warning text-center">{{ $graduation['ZB'] }}</td>
                            <td class="success text-center">{{ $studied['ZB'] }}</td>
                            <td class="info text-center">{{ $selected['ZB'] }}</td>
                            <td class="danger text-center">{{ $graduation['ZB'] - $studied['ZB'] - $selected['ZB'] }}</td>
                        </tr>
                        <tr>
                            <th rowspan="7" class="active text-center">选修学分数</th>
                            <th rowspan="4" class="active text-center">通识素质教育选修</th>
                            <th class="active text-center">人文社科<br>(TW)</th>
                            <td class="warning text-center">{{ $graduation['TW'] }}</td>
                            <td rowspan="7" class="warning text-center">{{ $graduation['TW'] + $graduation['TI'] + $graduation['TY'] + $graduation['TQ'] + $graduation['KX'] + $graduation['JX'] + $graduation['ZX'] }}</td>
                            <td class="success text-center">{{ $studied['TW'] }}</td>
                            <td rowspan="7" class="success text-center">{{ $studied['TW'] + $studied['TI'] + $studied['TY'] + $studied['TQ'] + $studied['KX'] + $studied['JX'] + $studied['ZX'] }}</td>
                            <td class="info text-center">{{ $selected['TW'] }}</td>
                            <td rowspan="7" class="info text-center">{{ $selected['TW'] + $selected['TI'] + $selected['TY'] + $selected['TQ'] + $selected['KX'] + $selected['JX'] + $selected['ZX'] }}</td>
                            <td class="danger text-center">{{ $graduation['TW'] - $studied['TW'] - $selected['TW'] }}</td>
                            <td rowspan="7" class="danger text-center">{{ ($graduation['TW'] + $graduation['TI'] + $graduation['TY'] + $graduation['TQ'] + $graduation['KX'] + $graduation['JX'] + $graduation['ZX']) - ($studied['TW'] + $studied['TI'] + $studied['TY'] + $studied['TQ'] + $studied['KX'] + $studied['JX'] + $studied['ZX']) - ($selected['TW'] + $selected['TI'] + $selected['TY'] + $selected['TQ'] + $selected['KX'] + $selected['JX'] + $selected['ZX']) }}</td>
                        </tr>
                        <tr>
                            <th class="active text-center">自然科学<br>(TI)</th>
                            <td class="warning text-center">{{ $graduation['TI'] }}</td>
                            <td class="success text-center">{{ $studied['TI'] }}</td>
                            <td class="info text-center">{{ $selected['TI'] }}</td>
                            <td class="danger text-center">{{ $graduation['TI'] - $studied['TI'] - $selected['TI'] }}</td>
                        </tr>
                        </tr>
                        <tr>
                            <th class="active text-center">艺术体育<br>(TY)</th>
                            <td class="warning text-center">{{ $graduation['TY'] }}</td>
                            <td class="success text-center">{{ $studied['TY'] }}</td>
                            <td class="info text-center">{{ $selected['TY'] }}</td>
                            <td class="danger text-center">{{ $graduation['TY'] - $studied['TY'] - $selected['TY'] }}</td>
                        </tr>
                        <tr>
                            <th class="active text-center">其他专项<br>(TQ)</th>
                            <td class="warning text-center">{{ $graduation['TQ'] }}</td>
                            <td class="success text-center">{{ $studied['TQ'] }}</td>
                            <td class="info text-center">{{ $selected['TQ'] }}</td>
                            <td class="danger text-center">{{ $graduation['TQ'] - $studied['TQ'] - $selected['TQ'] }}</td>
                        </tr>
                        <tr>
                            <th colspan="2" class="active text-center">学科专业教育选修<br>(KX)</th>
                            <td class="warning text-center">{{ $graduation['KX'] }}</td>
                            <td class="success text-center">{{ $studied['KX'] }}</td>
                            <td class="info text-center">{{ $selected['KX'] }}</td>
                            <td class="danger text-center">{{ $graduation['KX'] - $studied['KX'] - $selected['KX'] }}</td>
                        </tr>
                        <tr>
                            <th colspan="2" class="active text-center">教师资格教育选修<br>(JX)</th>
                            <td class="warning text-center">{{ $graduation['JX'] }}</td>
                            <td class="success text-center">{{ $studied['JX'] }}</td>
                            <td class="info text-center">{{ $selected['JX'] }}</td>
                            <td class="danger text-center">{{ $graduation['JX'] - $studied['JX'] - $selected['JX'] }}</td>
                        </tr>
                        <tr>
                            <th colspan="2" class="active text-center">专业拓展教育选修<br>(ZX)</th>
                            <td class="warning text-center">{{ $graduation['ZX'] }}</td>
                            <td class="success text-center">{{ $studied['ZX'] }}</td>
                            <td class="info text-center">{{ $selected['ZX'] }}</td>
                            <td class="danger text-center">{{ $graduation['ZX'] - $studied['ZX'] - $selected['ZX'] }}</td>
                        </tr>
                        <tr>
                            <th colspan="3" class="active text-center">总学分</th>
                            <td colspan="2" class="warning text-center">{{ array_sum($graduation) }}</td>
                            <td colspan="2" class="success text-center">{{ array_sum($studied) }}</td>
                            <td colspan="2" class="info text-center">{{ array_sum($selected) }}</td>
                            <td colspan="2" class="danger text-center">{{ array_sum($graduation) - array_sum($studied) - array_sum($selected) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@stop