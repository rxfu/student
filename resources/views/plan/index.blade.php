@extends('app')

@section('content')
<section class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading"><?php echo $session['college'] ?><?php echo $session['grade'] ?>级<?php echo $session['speciality'] ?>专业课程设置计划总表</div>
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
                            <?php foreach ($plans as $plan): ?>
                                <tr>
                                    <th class="active"><?php echo $plan['pt'] ?></th>
                                    <th class="active"><?php echo $plan['xz'] ?></th>
                                    <td><?php echo $plan['kch'] ?></td>
                                    <td><?php echo $plan['kcmc'] ?></td>
                                    <td><?php echo $plan['kcywmc'] ?></td>
                                    <td><?php echo $plan['zxf'] ?></td>
                                    <td><?php echo $plan['llxf'] ?></td>
                                    <td><?php echo $plan['syxf'] ?></td>
                                    <td><?php echo $plan['zxs'] ?></td>
                                    <td><?php echo $plan['llxs'] ?></td>
                                    <td><?php echo $plan['syxs'] ?></td>
                                    <td><?php echo $plan['kxq'] ?></td>
                                    <td><?php echo $plan['kh'] ?></td>
                                    <td><?php echo $plan['kkxy'] ?></td>
                                </tr>
                            <?php endforeach?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@stop