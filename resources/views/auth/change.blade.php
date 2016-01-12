@extends('app')

@section('content')
<section class="row">
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-body">
                <form id="passwordForm" name="passwordForm" action="{{ url('password/change') }}" role="form" method="post" class="form-horizontal">
                    <fieldset>
                        <div class="form-group">
                            <label for="old_password" class="col-md-3 control-label">旧密码</label>
                            <div class="col-md-9">
                                <input type="password" name="old_password" id="old_password" placeholder="旧密码" class="form-control" autofocus required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-md-3 control-label">新密码</label>
                            <div class="col-md-9">
                                <input type="password" name="newPassword" id="newPassword" placeholder="新密码" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation" class="col-md-3 control-label">确认密码</label>
                            <div class="col-md-9">
                                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="确认密码" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-9 col-md-offset-3">
                                <button type="submit" class="btn btn-lg btn-success btn-block">确认修改</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</section>
@stop