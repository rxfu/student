@extends('app')

@section('content')
<section class="row">
    <div class="col-sm-8 col-sm-offset-2">
        <form method="post" action="{{ url('selcourse/search') }}" role="form">
            <div class="input-group">
                <div class="form-group">
                    <label class="sr-only" for="keyword">课程检索</label>
                    <input type="search" class="form-control" id="keyword" name="keyword" placeholder="请输入课程序号或课程名称...">
                </div>
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit">Go!</button>
                </span>
            </div>
            <div class="voffset-top">
                <div class="col-sm-3">
                    <label for="grade">年度</label>
                    <select name="grade" id="grade" class="form-control">
                        <option value="*">==全部==</option>
                        <?php foreach ($grades as $grade): ?>
                            <option value="<?php echo $grade['nj'] ?>"><?php echo $grade['nj'] ?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="col-sm-4">
                    <label for="college">学院</label>
                    <select name="college" id="college" class="form-control">
                        <option value="*">==全部==</option>
                        <?php foreach ($colleges as $college): ?>
                            <option value="<?php echo $college['dw'] ?>"><?php echo $college['mc'] ?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="col-sm-5">
                    <label for="speciality">专业</label>
                    <select name="speciality" id="speciality" class="form-control">
                        <option value="*" class='*'>==全部==</option>
                        <?php foreach ($specialities as $speciality): ?>
                            <option value="<?php echo $speciality['zy'] ?>" class="<?php echo $speciality['xy'] ?>"><?php echo $speciality['mc'] ?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
        </form>
    </div>
</section>

<?php if (!isEmpty($courses)): ?>
    <section class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div role="tabpanel">
                        <ul id="campus-tab" class="nav nav-tabs" role="tablist">
                            <?php foreach (array_keys($courses) as $cid): ?>
                                <?php $campusId = 'campus-' . $cid?>
                                <li role="presentation"><a href="#<?php echo $campusId ?>" aria-controls="<?php echo $campusId ?>" role="tab" data-toggle="tab"><?php echo Dictionary::get('xqh', $cid) ?></a></li>
                            <?php endforeach?>
                        </ul>
                        <div class="tab-content">
                            <?php foreach (array_keys($courses) as $cid): ?>
                                <div id="campus-<?php echo $cid ?>" class="tab-pane fade<?php echo $cid == $session['campus'] ? ' in active' : '' ?>" role="tabpanel">
                                    <div class="table-responsive tab-table">
                                        <table class="table table-bordered table-striped table-hover course-table">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2" class="active">操作</th>
                                                    <th rowspan="2" class="active">课程序号</th>
                                                    <th rowspan="2" class="active">课程名称</th>
                                                    <th rowspan="2" class="active">学分</th>
                                                    <th rowspan="2" class="active">开课学院</th>
                                                    <th rowspan="2" class="active">专业</th>
                                                    <th rowspan="2" class="active">年级</th>
                                                    <th colspan="3" class="active text-center">上课时间</th>
                                                    <th rowspan="2" class="active">所在校区</th>
                                                    <th rowspan="2" class="active">主要任课老师</th>
                                                </tr>
                                                <tr>
                                                    <th class="active">起始周次</th>
                                                    <th class="active">星期</th>
                                                    <th class="active">起始节数</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($courses[$cid] as $course): ?>
                                                    <tr data-row="<?php echo $course[0]['kcxh'] ?>">
                                                        <?php $rowspan = count($course)?>
                                                        <td rowspan="<?php echo $rowspan ?>" class="text-center" id="<?php echo $course[0]['kcxh'] ?>">
                                                            <a class="btn btn-primary" href="<?php echo Route::to('course.apply', $type, $course[0]['kcxh']) ?>" title="申请修读" role="button">申请修读</a>
                                                        </td>
                                                        <td rowspan="<?php echo $rowspan ?>"><?php echo $course[0]['kcxh'] ?></td>
                                                        <td rowspan="<?php echo $rowspan ?>"><?php echo $course[0]['kcmc'] ?></td>
                                                        <td rowspan="<?php echo $rowspan ?>"><?php echo $course[0]['xf'] ?></td>
                                                        <td rowspan="<?php echo $rowspan ?>"><?php echo Dictionary::get('department', $course[0]['kkxy'], 'xt', 'dw') ?></td>
                                                        <td rowspan="<?php echo $rowspan ?>"><?php echo Dictionary::get('zy', $course[0]['zy'], 'jx', 'zy') ?></td>
                                                        <td rowspan="<?php echo $rowspan ?>"><?php echo $course[0]['nj'] ?></td>
                                                        <td><?php echo $course[0]['ksz'] ?>~<?php echo $course[0]['jsz'] ?></td>
                                                        <td><?php echo $course[0]['zc'] ?></td>
                                                        <td><?php echo $course[0]['ksj'] ?><?php echo $course[0]['jsj'] <= $course[0]['ksj'] ? '' : '~' . $course[0]['jsj'] ?></td>
                                                        <td><?php echo Dictionary::get('xqh', $course[0]['xqh']) ?></td>
                                                        <td><?php echo $course[0]['jsxm'] ?></td>
                                                    </tr>
                                                    <?php for ($i = 1; $i < $rowspan; ++$i): ?>
                                                        <tr data-name="<?php echo $course[0]['kcxh'] ?>">
                                                            <?php for ($j = 0; $j < 5; ++$j): ?>
                                                                <td style="display: none"></td>
                                                            <?php endfor;?>
                                                            <td><?php echo $course[$i]['ksz'] ?>~<?php echo $course[$i]['jsz'] ?></td>
                                                            <td><?php echo $course[$i]['zc'] ?></td>
                                                            <td><?php echo $course[$i]['ksj'] ?><?php echo $course[$i]['jsj'] <= $course[$i]['ksj'] ? '' : '~' . $course[$i]['jsj'] ?></td>
                                                            <td><?php echo Dictionary::get('xqh', $course[$i]['xqh']) ?></td>
                                                            <td><?php echo $course[$i]['jsxm'] ?></td>
                                                            <?php for ($j = 0; $j < 2; ++$j): ?>
                                                                <td style="display: none"></td>
                                                            <?php endfor;?>
                                                        </tr>
                                                    <?php endfor;?>
                                                <?php endforeach;?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            <?php endforeach?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif;?>
@stop