@extends('app')

@section('content')
<section class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">生成时间：{{ date('Y-m-d H:i:s') }}</div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th colspan="2" class="active">节次</th>
                                <th class="active">星期一</th>
                                <th class="active">星期二</th>
                                <th class="active">星期三</th>
                                <th class="active">星期四</th>
                                <th class="active">星期五</th>
                                <th class="active">星期六</th>
                                <th class="active">星期日</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 1; $i <= 5; ++$i): ?>
                                <tr>
                                    <?php if (1 == $i): ?>
                                        <th rowspan="5" class="active text-center" style="vertical-align:middle">上午</th>
                                    <?php endif;?>
                                    <th class="active">第<?php echo $i ?>节</th>
                                    <?php for ($j = 1; $j <= 7; ++$j): ?>
                                        <?php if (is_array($courses[$i][$j])): ?>
                                            <td<?php echo 1 < ($courses[$i][$j][0]['jsj'] - $i + 1) ? ' rowspan="' . ($courses[$i][$j][0]['jsj'] - $i + 1) . '"' : '' ?>>
                                                <?php foreach ($courses[$i][$j] as $course): ?>
                                                    <?php echo $course['kcmc'] ?><br>
                                                    <?php echo $course['xqh'] ?>校区<?php echo $course['jsmc'] ?>教室<br>
                                                    <?php echo $course['jsxm'] ?><br>
                                                    第 <?php echo $course['ksz'] ?>~<?php echo $course['jsz'] ?> 周
                                                    <hr>
                                                <?php endforeach;?>
                                            </td>
                                        <?php elseif (!is_null($courses[$i][$j])): ?>
                                            <td><?php echo $courses[$i][$j] ?></td>
                                        <?php endif;?>
                                    <?php endfor;?>
                                </tr>
                            <?php endfor;?>
                            <tr>
                                <td colspan="9" class="text-center">午休</td>
                            </tr>
                            <?php for ($i = 6; $i <= 9; ++$i): ?>
                                <tr>
                                    <?php if (6 == $i): ?>
                                        <th rowspan="4" class="active text-center" style="vertical-align:middle">下午</th>
                                    <?php endif;?>
                                    <th class="active">第<?php echo $i ?>节</th>
                                    <?php for ($j = 1; $j <= 7; ++$j): ?>
                                        <?php if (is_array($courses[$i][$j])): ?>
                                            <td<?php echo 1 < ($courses[$i][$j][0]['jsj'] - $i + 1) ? ' rowspan="' . ($courses[$i][$j][0]['jsj'] - $i + 1) . '"' : '' ?>>
                                                <?php foreach ($courses[$i][$j] as $course): ?>
                                                    <?php echo $course['kcmc'] ?><br>
                                                    <?php echo $course['xqh'] ?>校区<?php echo $course['jsmc'] ?>教室<br>
                                                    <?php echo $course['jsxm'] ?><br>
                                                    第 <?php echo $course['ksz'] ?>~<?php echo $course['jsz'] ?> 周
                                                    <hr>
                                                <?php endforeach;?>
                                            </td>
                                        <?php elseif (!is_null($courses[$i][$j])): ?>
                                            <td><?php echo $courses[$i][$j] ?></td>
                                        <?php endif;?>
                                    <?php endfor;?>
                                </tr>
                            <?php endfor;?>
                            <tr>
                                <td colspan="9" class="text-center">晚饭</td>
                            </tr>
                            <?php for ($i = 10; $i <= 12; ++$i): ?>
                                <tr>
                                    <?php if (10 == $i): ?>
                                        <th rowspan="3" class="active text-center" style="vertical-align:middle">晚上</th>
                                    <?php endif;?>
                                    <th class="active">第<?php echo $i ?>节</th>
                                    <?php for ($j = 1; $j <= 7; ++$j): ?>
                                        <?php if (is_array($courses[$i][$j])): ?>
                                            <td<?php echo 1 < ($courses[$i][$j][0]['jsj'] - $i + 1) ? ' rowspan="' . ($courses[$i][$j][0]['jsj'] - $i + 1) . '"' : '' ?>>
                                                <?php foreach ($courses[$i][$j] as $course): ?>
                                                    <?php echo $course['kcmc'] ?><br>
                                                    <?php echo $course['xqh'] ?>校区<?php echo $course['jsmc'] ?>教室<br>
                                                    <?php echo $course['jsxm'] ?><br>
                                                    第 <?php echo $course['ksz'] ?>~<?php echo $course['jsz'] ?> 周
                                                    <hr>
                                                <?php endforeach;?>
                                            </td>
                                        <?php elseif (!is_null($courses[$i][$j])): ?>
                                            <td><?php echo $courses[$i][$j] ?></td>
                                        <?php endif;?>
                                    <?php endfor;?>
                                </tr>
                            <?php endfor;?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel-footer">生成时间：{{ date('Y-m-d H:i:s') }}</div>
        </div>
    </div>
</section>
@stop