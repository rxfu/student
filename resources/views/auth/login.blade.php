<!DOCTYPE html>
<html lang="zh">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="用于广西师范大学学生信息管理，学生选课，查询成绩">
        <meta name="keywords" content="广西师范大学,教务处,学生选课,成绩查询">
        <meta name="author" content="Fu Rongxin,符荣鑫">
        <title>广西师范大学教务管理系统</title>
        <!--link rel="shortcut icon" href="favicon.ico"-->
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/formValidation.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/bootstrap-theme.min.css') }}">
        <link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/sb-admin-2.css') }}">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
        <!--[if lt IE 9]>
            <script src="{{ asset('js/html5shiv.js') }}"></script>
            <script src="{{ asset('js/respond.min.js') }}"></script>
        <![endif]-->
    </head>

    <body>
    	<div class="container">
			<div class="row">
			    <div class="col-sm-4 col-sm-offset-4">
			        <div class="login-panel panel panel-default">
			            <div class="panel-heading">
			                <h3 class="panel-title">学生登录</h3>
			            </div>
			            <!-- /.panel-heading -->

			            <div class="panel-body">
			                <form id="loginForm" name="loginForm" action="{{ url('auth/login') }}" role="form" method="POST" class="form-horizontal">
			                	{!! csrf_token() !!}
			                    <fieldset>
			                        <div class="form-group">
			                            <label for="username" class="col-sm-3 control-label">用户名</label>
			                            <div class="col-sm-9">
			                                <input type="text" name="username" id="username" placeholder="用户名" class="form-control" autofocus required>
			                            </div>
			                        </div>
			                        <div class="form-group">
			                            <label for="password" class="col-sm-3 control-label">密码</label>
			                            <div class="col-sm-9">
			                                <input type="password" name="password" id="password" placeholder="密码" class="form-control" required>
			                            </div>
			                        </div>
			                        <div class="form-group">
			                            <div class="col-sm-9 col-sm-offset-3">
			                                <button type="submit" class="btn btn-lg btn-success btn-block">登录</button>
			                            </div>
			                        </div>
			                    </fieldset>
			                </form>
			            </div>
			            <!-- /.panel-body -->
			        </div>
			        <!-- /.panel -->
			    </div>
			    <!-- /.col-sm-4 -->
			</div>
			<!-- /.row -->
		</div>
		<!-- /.container -->

        <!-- Load JS here for greater good -->
        <script src="{{ asset('js/jquery-1.11.0.min.js') }}"></script>
        <script src="{{ asset('js/jquery-ui-1.10.4.custom.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/formValidation.min.js') }}"></script>
        <script src="{{ asset('js/language/zh_CN.js') }}"></script>
        <script src="{{ asset('js/jquery.placeholder.js') }}"></script>
        <script src="{{ asset('js/sb-admin-2.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>