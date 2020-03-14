<!DOCTYPE html>
<html lang="zh">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="用于广西师范大学教师信息管理，录入成绩，查询成绩，教师评学">
        <meta name="keywords" content="广西师范大学,教务处,教师信息管理,成绩录入,成绩查询,教师评学">
        <meta name="author" content="Fu Rongxin,符荣鑫">
        <title>教师登录 - 广西师范大学教师信息管理系统</title>
        <!--link rel="shortcut icon" href="favicon.ico"-->
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
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
        <div id="wrapper">
	    	<main class="container">
				<div class="row">
				    <div class="col-sm-4 col-sm-offset-4">
				        <div class="panel panel-default login-panel">
				            <div class="panel-heading">
				                <h3 class="panel-title">教师登录</h3>
				            </div>
				            <!-- /.panel-heading -->

				            <div class="panel-body">
				                <h3 class="text-center">错误：{{ $message }}</h3>
				                <h4 class="text-center">
				                	<a href="{{ url('/cas_logout') }}">退出系统</a>
				                </h4>
				            </div>
				            <!-- /.panel-body -->
				        </div>
				        <!-- /.panel -->
				    </div>
				    <!-- /.col-sm-4 -->
				</div>
				<!-- /.row -->
			</main>
			<!-- /.container -->
		</div>
		<!-- /#wrapper -->

        <!-- Load JS here for greater good -->
        <script src="{{ asset('js/jquery-1.12.0.min.js') }}"></script>
        <script src="{{ asset('js/jquery-ui-1.10.4.custom.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/language/zh_CN.js') }}"></script>
        <script src="{{ asset('js/jquery.placeholder.js') }}"></script>
        <script src="{{ asset('js/sb-admin-2.js') }}"></script>
    </body>
</html>