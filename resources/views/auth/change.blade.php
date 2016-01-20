@extends('app')

@section('content')
<section class="row">
    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-body">
                <form id="passwordForm" name="passwordForm" action="{{ url('password/change') }}" role="form" method="post" class="form-horizontal">
                    {!! method_field('put') !!}
                	{!! csrf_field() !!}
                    <fieldset>
                        <div class="form-group">
                            <label for="old_password" class="col-sm-3 control-label">旧密码</label>
                            <div class="col-sm-9">
                                <input type="password" name="old_password" id="old_password" placeholder="旧密码" class="form-control" autofocus required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-3 control-label">新密码</label>
                            <div class="col-sm-9">
                                <input type="password" name="password" id="password" placeholder="新密码" class="form-control" required>
                                <p class="help-block">请输入至少6个字符</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation" class="col-sm-3 control-label">确认密码</label>
                            <div class="col-sm-9">
                                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="确认密码" class="form-control" required>
                                <p class="help-block">与新密码一致</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-9 col-sm-offset-3">
                                <button type="submit" class="btn btn-success btn-block">确认修改</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</section>
@stop