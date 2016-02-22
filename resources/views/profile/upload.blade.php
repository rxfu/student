@extends('app')

@section('content')
<section class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <form id="upfile" name="upfile" action="{{ url('profile/upload') }}" role="form" method="post" enctype="multipart/form-data" class="form-inline">
                	{!! csrf_field() !!}
                    <fieldset>
                        <div class="form-group">
                            <label for="file" class="control-label">照片路径</label>
                            <input type="file" name="file" id="file" placeholder="照片路径" class="form-control" autofocus required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-block">提交</button>
                        </div>
                    </fieldset>
                </form>
	            <p class="help-block">
	                <strong>上传说明：</strong>请上传图像要求为高{{ config('constants.file.image.height') }}（像素）*宽{{ config('constants.file.image.width') }}（像素）的蓝底免冠证件照，要求{{ config('constants.file.image.ext') }}格式，大小不得超过2MB。
	            </p>
                <div class="text-center">
                    <img src="{{ url('profile/portrait') }}" alt="{{ Auth::user()->profile->xm }}" />
                </div>
            </div>
        </div>
    </div>
</section>
@stop

@push('scripts')
<script>
@if (!$exists || config('constants.file.status.none') == $status)
    alert('请上传图像要求为高320（像素）*宽240（像素）的蓝底免冠证件照，要求jpg格式，方能进行考试报名。若因照片不符合要求而引起的考生无法参加考试等情况，由考生自行负责。');
@elseif (config('constants.file.status.uploaded') == $status)
    alert('考生照片未审核，待审核通过后方能进行报名，审核将于半个工作日内完成。');
@elseif (config('constants.file.status.refused') == $status)
    alert('考生照片审核不合格，请上传图像要求为高320（像素）*宽240（像素）的蓝底免冠证件照，要求jpg格式，待审核通过后方能进行报名，审核将于半个工作日内完成。');
@elseif (config('constants.file.status.passed') == $status)
    alert('请核对考生个人信息无误并确认本人照片为符合要求的蓝底免冠证件照，方能进行考试报名。若因照片不符合要求而引起的考生无法参加考试等情况，由考生自行负责。');
@endif
</script>
@endpush