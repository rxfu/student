@extends('app')

@section('content')
<section class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover data-table">
                        <thead>
                            <tr>
                                <th class="active">申请时间</th>
                                <th class="active">年度</th>
                                <th class="active">学期</th>
                                <th class="active">课程序号</th>
                                <th class="active">学分</th>
                                <th class="active">原年度</th>
                                <th class="active">原学期</th>
                                <th class="active">原课程序号</th>
                                <th class="active">原学分</th>
                                <th class="active">申请类型</th>
                                <th class="active">审核意见</th>
                                <th class="active">申请状态</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($courses as $course): ?>
                            <tr>
                                <td><?php echo $course['xksj'] ?></td>
                                <td><?php echo $course['nd'] ?></td>
                                <td><?php echo Dictionary::get('xq', $course['xq']) ?></td>
                                <td><?php echo $course['kcxh'] ?></td>
                                <td><?php echo $course['xf'] ?></td>
                                <td><?php echo $course['ynd'] ?></td>
                                <td><?php echo isEmpty($course['yxq']) ? $course['yxq'] : Dictionary::get('xq', $course['yxq']) ?></td>
                                <td><?php echo $course['ykcxh'] ?></td>
                                <td><?php echo $course['yxf'] ?></td>
                                <td><?php switch ($course['xklx']) {
case 0:
	echo '其他课程';
	break;
case 1:
	echo '重修';
	break;
default:
	echo '其他课程';
	break;
}?></td>
                                <td><?php echo $course['shyj'] ?></td>
                                <td>
                                    <?php if (Config::get('course.apply.passed') == $course['sh']): ?>
                                        已批准
                                    <?php elseif (Config::get('course.apply.refused') == $course['sh']): ?>
                                        已拒绝
                                    <?php elseif (Config::get('course.apply.unauditted') == $course['sh']): ?>
                                        <form method="post" name="revoke" action="<?php echo Route::to('course.revoke') ?>" role="form">
                                            <input type="hidden" name="cno" value="<?php echo $course['kcxh'] ?>">
                                            <button type="button" class="btn btn-primary" title="撤销申请" data-toggle="modal" data-target="#confirmDialog" data-title="撤销选课申请" data-message="你确定要撤销<?php echo $course['kcxh'] ?>课程的选课申请？">撤销申请</button>
                                        </form>
                                    <?php endif;?>
                                </td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@stop