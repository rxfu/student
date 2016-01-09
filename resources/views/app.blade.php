<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="用于广西师范大学教务管理，学生选课，录入成绩">
        <meta name="keywords" content="广西师范大学,教务处,学生选课,教师管理,成绩管理">
        <meta name="author" content="Fu Rongxin,符荣鑫">
        <title>广西师范大学教务管理系统</title>
        <!--link rel="shortcut icon" href="favicon.ico"-->
        <?php echo css('css/bootstrap.min.css') ?>
        <?php echo css('css/formValidation.min.css') ?>
        <?php echo css('css/bootstrap-select.css') ?>
        <?php echo css('css/bootstrap-theme.css') ?>
        <?php echo css('font-awesome/css/font-awesome.min.css') ?>
        <?php echo css('css/plugins/dataTables/dataTables.bootstrap.css') ?>
        <?php echo css('css/sb-admin-2.css') ?>
        <?php echo css('css/timeline.css') ?>
        <?php echo css('css/style.css') ?>

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
        <!--[if lt IE 9]>
            <?php echo js('js/html5shiv.js') ?>
            <?php echo js('js/respond.min.js') ?>
        <![endif]-->
    </head>

    <body>
        <div id="wrapper">
            <div id="browserAlert" class="alert alert-danger">
               <a href="#" class="close" data-dismiss="alert" aria-lable="关闭">
                  <span aria-hidden="true">&times;</span>
               </a>
               <strong>注意！</strong> 你现在使用的是<strong>360浏览器</strong>，将不能正确提交成绩，请更换其他浏览器以便正确提交成绩！
            </div>
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
                © <?php print(date('Y') == '2014') ? '2014' : '2014 - ' . date('Y')?> <a href="http://www.dean.gxnu.edu.cn">广西师范大学教务处</a>.版权所有.
            </footer>
        </div>

        <!-- Load JS here for greater good -->
        <?php echo js('js/jquery-1.11.0.min.js') ?>
        <?php echo js('js/jquery-ui-1.10.4.custom.min.js') ?>
        <?php echo js('js/bootstrap.min.js') ?>
        <?php echo js('js/formValidation.min.js') ?>
        <?php echo js('js/framework/bootstrap.min.js') ?>
        <?php echo js('js/language/zh_CN.js') ?>
        <?php echo js('js/bootstrap-paginator.js') ?>
        <?php echo js('js/bootstrap-select.js') ?>
        <?php echo js('js/bootstrap-switch.js') ?>
        <?php echo js('js/bootstrap-typeahead.js') ?>
        <?php echo js('js/jquery.placeholder.js') ?>
        <?php echo js('js/jquery.stacktable.js') ?>
        <?php echo js('js/jquery.chained.min.js') ?>
        <?php echo js('js/plugins/metisMenu/jquery.metisMenu.js') ?>
        <?php echo js('js/plugins/dataTables/jquery.dataTables.min.js') ?>
        <?php echo js('js/plugins/dataTables/dataTables.bootstrap.js') ?>
        <?php echo js('js/sb-admin-2.js') ?>
        <?php echo js('js/jquery.ua.js') ?>
        <?php echo js('js/main.js') ?>
    </body>
</html>