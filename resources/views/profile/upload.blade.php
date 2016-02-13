@extends('app')

@section('content')
<section class="row">
    <div class="col-sm-6">
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
	                <strong>上传说明：</strong>请上传图像要求为高320（像素）*宽240（像素）的蓝底免冠证件照，要求jpg格式，大小不得超过2MB。
	            </p>
                <div>
                    <img src="#" alt="{{ Auth::user()->profile->xm }}" />
                </div>
            </div>
        </div>
    </div>
</section>
@stop