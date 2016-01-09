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
        <link rel="stylesheet" href="{{ asset('css/bootstrap-select.css') }}">
        <link rel="stylesheet" href="{{ asset('css/bootstrap-theme.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/metisMenu.min.css') }}">
        <link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/plugins/dataTables/dataTables.bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('css/sb-admin-2.css') }}">
        <link rel="stylesheet" href="{{ asset('css/timeline.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
        <!--[if lt IE 9]>
            <script src="{{ asset('js/html5shiv.js') }}"></script>
            <script src="{{ asset('js/respond.min.js') }}"></script>
        <![endif]-->
    </head>

    <body>
        <div id="wrapper">

            <!-- Browser alert -->
            <div id="browserAlert" class="alert alert-danger">
               <a href="#" class="close" data-dismiss="alert" aria-lable="关闭">
                  <span aria-hidden="true">&times;</span>
               </a>
               <strong>注意！</strong> 你现在使用的是<strong>360浏览器</strong>，将不能正确提交成绩，请更换其他浏览器以便正确提交成绩！
            </div>
            <!-- /#browserAlert -->

            <!-- 页面头部Logo -->
            <header role="banner"></header>

            <?php if (isset($session['logged']) && true == $session['logged']): ?>
                <?php if (Config::get('user.role.student') == $session['role']): ?>
                    <?php include partial('student.navigation')?>
                <?php elseif (Config::get('user.role.teacher') == $session['role']): ?>
                    <?php include partial('teacher.navigation')?>
                <?php endif;?>

                <!-- 页面主体 -->
                <main id="page-wrapper">
            <?php else: ?>
                <!-- 页面主体 -->
                <main class="container">
            <?php endif;?>

            <?php if (Message::has()): ?>
                <!-- 页面消息 -->
                <section class="row">
                    <div class="col-lg-12">
                        <?php Message::display()?>
                    </div>
                </section>
            <?php endif;?>

            <!-- 数据加载 -->
            <div id="loading">
                <img src="<?php echo img('images/loading.gif') ?>" alt="加载中">
                <p>加载中……请稍后</p>
            </div>

            <article>
                </article>
            </main>

            <!-- 页脚版权信息 -->
            <footer class="footer" role="contentinfo">
                © {{ (date('Y') == '2014') ? '2014' : '2014 - ' . date('Y') }} <a href="http://www.dean.gxnu.edu.cn">广西师范大学教务处</a>.版权所有.
            </footer>
        </div>
        <!-- /#wrapper -->

        <!-- Load JS here for greater good -->
        <script src="{{ asset('js/jquery-1.11.0.min.js') }}"></script>
        <script src="{{ asset('js/jquery-ui-1.10.4.custom.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/formValidation.min.js') }}"></script>
        <script src="{{ asset('js/language/zh_CN.js') }}"></script>
        <script src="{{ asset('js/bootstrap-paginator.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap-switch.js') }}"></script>
        <script src="{{ asset('js/bootstrap-typeahead.js') }}"></script>
        <script src="{{ asset('js/jquery.placeholder.js') }}"></script>
        <script src="{{ asset('js/jquery.stacktable.js') }}"></script>
        <script src="{{ asset('js/jquery.chained.min.js') }}"></script>
        <script src="{{ asset('js/metisMenu.min.js') }}"></script>
        <script src="{{ asset('js/plugins/dataTables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('js/plugins/dataTables/dataTables.bootstrap.js') }}"></script>
        <script src="{{ asset('js/sb-admin-2.js') }}"></script>
        <script src="{{ asset('js/jquery.ua.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>