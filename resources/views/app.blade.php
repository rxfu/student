<!DOCTYPE html>
<html lang="zh">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="用于广西师范大学学生信息管理，学生选课，查询成绩">
        <meta name="keywords" content="广西师范大学,教务处,学生信息管理,学生选课,成绩查询">
        <meta name="author" content="Fu Rongxin,符荣鑫">
        <title>{{ $title }} - 广西师范大学学生信息管理系统</title>
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
            <!-- Header -->
            <header class="header" role="banner"></header>
            <!-- /.header -->

            <!-- Browser alert -->
            <section id="browserAlert" class="alert alert-danger">
               <a href="#" class="close" data-dismiss="alert" aria-lable="关闭">
                  <span aria-hidden="true">&times;</span>
               </a>
               <strong>注意！</strong> 你现在使用的是<strong>360浏览器</strong>，将不能正确提交成绩，请更换其他浏览器以便正确提交成绩！
            </section>
            <!-- /#browserAlert -->

            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom:0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                    <a href="{{ route('home') }}" class="navbar-brand">广西师范大学学生选课系统</a>
                </div>
                <!-- /.navbar-header -->

                <ul class="nav navbar-top-links navbar-right">
                    <li>欢迎{{ $profile->college->mc . $profile->nj }}级{{ $profile->major->mc }}专业{{ $profile->xm }}同学使用选课系统！</li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-user fa-fw"></i>
                            <span>{{ $profile->xm }}</span>
                            <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="{{ url('profile') }}"><i class="fa fa-user fa-fw"></i> 个人资料</a></li>
                            <li><a href="{{ url('password/change') }}"><i class="fa fa-unlock fa-fw"></i> 修改密码</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ url('logout') }}"><i class="fa fa-sign-out fa-fw"></i> 登出</a></li>
                        </ul>
                    </li>
                </ul>
                <!-- /.navbar-top-links -->

                <!-- Menu -->
                <aside class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul id="side-menu" class="nav">
                            <li>
                                <a href="#"><i class="fa fa-ticket fa-fw"></i> 新生信息填写</a>
                                <a href="{{ url('home') }}"><i class="fa fa-dashboard fa-fw"></i> 综合管理系统</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-graduation-cap fa-fw"></i> 教学计划<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="#">课程信息</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('plan') }}">教学计划</a>
                                    </li>
                                    <li>
                                        <a href="#>">毕业要求</a>
                                    </li>
                                    <li>
                                        <a href="#">选课情况表</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-table fa-fw"></i> 选课管理<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                        <li>
                                            <a href="#">公共课程</a>
                                        </li>
                                        <li>
                                            <a href="#">必修课程</a>
                                        </li>
                                        <li>
                                            <a href="#">选修课程</a>
                                        </li>
                                            <li>
                                                <a href="#"> 通识素质课程<span class="fa arrow"></span></a>
                                                <ul class="nav nav-third-level">
                                                    <li>
                                                        <a href="#">人文社科通识素质课程</a>
                                                    </li>
                                                    <li>
                                                        <a href="#">自然科学通识素质课程</a>
                                                    </li>
                                                    <li>
                                                        <a href="#">艺术体育通识素质课程</a>
                                                    </li>
                                                    <li>
                                                        <a href="#">其他专项通识素质课程</a>
                                                    </li>
                                                </ul>
                                                <!-- /.nav-third-level -->
                                            </li>
                                            <li>
                                                <a href="#">其他课程</a>
                                            </li>
                                        <li>
                                            <a href="#">重修课程</a>
                                        </li>
                                        <li>
                                            <a href="#">可退选课程列表</a>
                                        </li>
                                    <li>
                                        <a href="#">课程申请进度</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-calendar fa-fw"></i> 课表管理<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="#">课程表</a>
                                    </li>
                                    <li>
                                        <a href="#">已选课程列表</a>
                                    </li>
                                    <li>
                                        <a href="#">本学期专业课程表</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-tasks fa-fw"></i> 成绩管理<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="#">待确认成绩单</a>
                                    </li>
                                    <li>
                                        <a href="#">综合成绩单</a>
                                    </li>
                                    <li>
                                        <a href="#">国家考试成绩单</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-tablet fa-fw"></i> 考试报名<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                            <li>
                                                <a href="#">#<span class="fa arrow"></span></a>
                                                <ul class="nav nav-third-level">
                                                        <li>
                                                            <a href="#">#</a>
                                                        </li>
                                                </ul>
                                            </li>
                                    <li>
                                        <a href="#">历史报名信息</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <!--li>
                                <a href="#"><i class="fa fa-pencil-square-o fa-fw"></i> 教学评价<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="#">未评课程</a>
                                    </li>
                                    <li>
                                        <a href="#">已评课程</a>
                                    </li>
                                </ul>
                            </li-->
                            <!--li>
                                <a href="#"><i class="fa fa-apple fa-fw"></i> 学分申请<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="#">课程转换申请<span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">
                                            <li>
                                                <a href="#">课程转换</a>
                                            </li>
                                            <li>
                                                <a href="#">申请进度</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">创新学分申请<span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">
                                            <li>
                                                <a href="#">学科竞赛获奖</a>
                                                <a href="#">发表科研论文</a>
                                                <a href="#">专利授权</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li-->
                            <!--li>
                                <a href="#"><i class="fa fa-university fa-fw"></i> 教室管理<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="#">空教室查询</a>
                                        <a href="#">空教室申请</a>
                                    </li>
                                </ul>
                            </li-->
                            <li>
                                <a href="#"><i class="fa fa-gear fa-fw"></i> 系统管理<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="{{ url('profile') }}">个人资料</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('log') }}">选课日志</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('message') }}">系统消息</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('password/change') }}">修改密码</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <li>
                                <a href="{{ url('logout') }}"><i class="fa fa-sign-out fa-fw"></i> 登出</a>
                            </li>
                        </ul>
                        <!-- /#side-menu -->
                    </div>
                    <!-- /.sidebar-nav -->
                </aside>
                <!-- /.navbar-sidebar -->
            </nav>
            <!-- /.navbar -->

            <!-- Page wrapper -->
            <main id="page-wrapper">
                @if (session('status'))
                <!-- Status -->
                <section class="row">
                    <div class="col-sm-12">
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{ session('status') }}
                        </div>
                    </div>
                    <!-- /.col-sm-12 -->
                </section>
                <!-- /.row -->
                @endif

                @if ($errors->any())
                <!-- Errors -->
                <section class="row">
                    <div class="col-sm-12">
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>注意：出错啦！</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- /.col-sm-12 -->
                </section>
                <!-- /.row -->
                @endif

                <article class="row">
                    <header class="col-sm-12">
                        <h1 class="page-header">{{ $title }}</h1>
                    </header>
                    <!-- /.col-sm-12 -->

                    <!-- Loading -->
                    <section id="loading">
                        <img src="{{ asset('images/loading.gif') }}" alt="加载中">
                        <p>加载中……请稍后</p>
                    </section>

                    @yield('content')
                </article>
                <!-- /.row -->
            </main>
            <!-- /#page-wrapper -->

            <!-- Copyright -->
            <footer class="footer" role="contentinfo">
                &copy; {{ (date('Y') == '2014') ? '2014' : '2014 - ' . date('Y') }} <a href="http://www.dean.gxnu.edu.cn">广西师范大学教务处</a>.版权所有.
            </footer>
            <!-- /.footer -->
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