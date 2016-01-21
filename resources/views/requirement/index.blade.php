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
                            <th colspan="2" class="active text-center">至少应修读学分数</th>
                        </tr>
                        <tr>
                            <th rowspan="5" class="active text-center">必修学分数</th>
                            <th colspan="2" class="active text-center">通识素质教育<br>(TB)</th>
                            <td class="text-center">{{ $graduation['TB'] }}</td>
                            <td rowspan="5" class="text-center">{{ $graduation['TB'] + $graduation['KB'] + $graduation['JB'] + $graduation['SB'] + $graduation['ZB'] }}</td>
                        </tr>
                        <tr>
                            <th colspan="2" class="active text-center">学科专业教育<br>(KB)</th>
                            <td class="text-center">{{ $graduation['KB'] }}</td>
                        </tr>
                        <tr>
                            <th colspan="2" class="active text-center">教师资格教育<br>(JB)</th>
                            <td class="text-center">{{ $graduation['JB'] }}</td>
                        </tr>
                        <tr>
                            <th colspan="2" class="active text-center">集中实践教育<br>(SB)</th>
                            <td class="text-center">{{ $graduation['SB'] }}</td>
                        </tr>
                        <tr>
                            <th colspan="2" class="active text-center">专业拓展教育<br>(ZB)</th>
                            <td class="text-center">{{ $graduation['ZB'] }}</td>
                        </tr>
                        <tr>
                            <th rowspan="7" class="active text-center">选修学分数</th>
                            <th rowspan="4" class="active text-center">通识素质教育选修</th>
                            <th class="active text-center">人文社科<br>(TW)</th>
                            <td class="text-center">{{ $graduation['TW'] }}</td>
                            <td rowspan="7" class="text-center">{{ $graduation['TW'] + $graduation['TI'] + $graduation['TY'] + $graduation['TQ'] + $graduation['KX'] + $graduation['JX'] + $graduation['ZX'] }}</td>
                        </tr>
                        <tr>
                            <th class="active text-center">自然科学<br>(TI)</th>
                            <td class="text-center">{{ $graduation['TI'] }}</td>
                        </tr>
                        <tr>
                            <th class="active text-center">艺术体育<br>(TY)</th>
                            <td class="text-center">{{ $graduation['TY'] }}</td>
                        </tr>
                        <tr>
                            <th class="active text-center">其他专项<br>(TQ)</th>
                            <td class="text-center">{{ $graduation['TQ'] }}</td>
                        </tr>
                        <tr>
                            <th colspan="2" class="active text-center">学科专业教育选修<br>(KX)</th>
                            <td class="text-center">{{ $graduation['KX'] }}</td>
                        </tr>
                        <tr>
                            <th colspan="2" class="active text-center">教师资格教育选修<br>(JX)</th>
                            <td class="text-center">{{ $graduation['JX'] }}</td>
                        </tr>
                        <tr>
                            <th colspan="2" class="active text-center">专业拓展教育选修<br>(ZX)</th>
                            <td class="text-center">{{ $graduation['ZX'] }}</td>
                        </tr>
                        <tr>
                            <th colspan="3" class="active text-center">总学分</th>
                            <td colspan="2" class="text-center">{{ $graduation['TB'] + $graduation['KB'] + $graduation['JB'] + $graduation['SB'] + $graduation['ZB'] + $graduation['TW'] + $graduation['TI'] + $graduation['TY'] + $graduation['TQ'] + $graduation['KX'] + $graduation['JX'] + $graduation['ZX'] }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@stop