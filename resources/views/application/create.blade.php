@extends('app')

@section('content')
<section class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <form id="appForm" name="appForm" method="post" action="{{ route('application.store') }}" class="form-horizontal">
                	{!! csrf_field() !!}
                	<input type="hidden" name="type" value="{{ $type }}">
                    <div class="form-group">
                        <label for="kcxh" class="col-sm-2 control-label">课程序号</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="kcxh" name="kcxh" value="{{ $kcxh }}" disabled>
                        </div>
                    </div>
                    @if ('retake' == $type)
                        <div class="form-group">
                            <label for="ynd" class="col-sm-2">原年度</label>
                            <div class="col-sm-4">
                                <input type="text" name="lyear-name" id="lyear-name" class="form-control" value="<?php echo $lcnos[0]['nd'] ?>年度" disabled>
                                <input type="hidden" name="lyear" id="lyear" value="<?php echo $lcnos[0]['nd'] ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="yxq" class="col-sm-2">原学期</label>
                            <div class="col-sm-4">
                                <input type="text" name="lterm-name" id="lterm-name" class="form-control" value="<?php echo Dictionary::get('xq', $lcnos[0]['xq']) ?>学期" disabled>
                                <input type="hidden" name="lterm" id="lterm" value="<?php echo $lcnos[0]['xq'] ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ykch" class="col-sm-2">原课程</label>
                            <div class="col-sm-4">
                                <select name="lcno" id="lcno" class="form-control">
                                    <?php foreach ($lcnos as $lcno): ?>
                                        <option data-year="<?php echo $lcno['nd'] ?>" data-year-name="<?php echo $lcno['nd'] ?>年度" data-term="<?php echo $lcno['xq'] ?>" data-term-name="<?php echo Dictionary::get('xq', $lcno['xq']) ?>学期" value="<?php echo $lcno['kcxh'] ?>"><?php echo $lcno['kcxh'] ?>-<?php echo $lcno['kcmc'] ?>-<?php echo $lcno['xf'] ?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="lcredit" id="lcredit" value="<?php echo $lcnos[0]['xf'] ?>">
                    @endif
                    <div class="form-group">
                        <div class="col-sm-6 col-sm-offset-2">
                            <button type="submit" class="btn btn-primary">提交申请</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@stop