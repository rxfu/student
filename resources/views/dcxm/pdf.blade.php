<!DOCTYPE html>
<html lang="zh">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="用于广西师范大学学生信息管理，学生选课，查询成绩">
        <meta name="keywords" content="广西师范大学,教务处,学生信息管理,学生选课,成绩查询">
        <meta name="author" content="Fu Rongxin,符荣鑫">
        <title>{{ $title or '默认页面'}} - 广西师范大学学生信息管理系统</title>
        <!--link rel="shortcut icon" href="favicon.ico"-->
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <style>
            body {
                font-family: SimSun;
                font-size: 12pt;
            }
            h1 {
                font-size: 26pt;
                font-weight: bold;
                line-height: 39pt;
            }
            h2 {
                font-size: 16pt;
                font-family: STFangsong, FangSong, SimSun;
                line-height: 24pt;
            }
            .space-line {
                line-height: 16pt;
            }
        </style>

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
        <!--[if lt IE 9]>
            <script src="{{ asset('js/html5shiv.js') }}"></script>
            <script src="{{ asset('js/respond.min.js') }}"></script>
        <![endif]-->
    </head>

    <body>
        <main>
            <!--header id="header" class="row">
                <div class="col-sm-12">
                    <a href="{{ url('dcxm/pdf/download/' . $project->id) }}" title="下载" role="button" class="btn btn-primary">下载</a>
                </div>
            </header--><!-- /header -->

            <article>
                <div class="space-line">&nbsp;</div>
                <div class="space-line">&nbsp;</div>

                <header class="row">
                    <div class="col-sm-4 col-sm-offset-4">
                        <h1 class="text-center">广西高校大学生创新创业<br>计划项目申报书</h1>
                    </div>
                </header>

                <div class="space-line">&nbsp;</div>
                <div class="space-line">&nbsp;</div>
                <div class="space-line">&nbsp;</div>
                <div class="space-line">&nbsp;</div>
                <div class="space-line">&nbsp;</div>

                <div class="row">
                    <div class="col-sm-2 col-sm-offset-4">
                        <h2 class="text-right">项目名称：</h2>
                    </div>
                    <div class="col-sm-2">
                        <h2 class="text-left">{{ $project->xmmc }}</h2>
                    </div>
                    <div class="col-sm-2 col-sm-offset-4">
                        <h2 class="text-right">项目类别：</h2>
                    </div>
                    <div class="col-sm-2">
                        <h2 class="text-left">{{ $project->category->mc }}</h2>
                    </div>
                    <div class="col-sm-2 col-sm-offset-4">
                        <h2 class="text-right">项目负责人：</h2>
                    </div>
                    <div class="col-sm-2">
                        <h2 class="text-left">{{ $profile->xm }}</h2>
                    </div>
                    <div class="col-sm-2 col-sm-offset-4">
                        <h2 class="text-right">负责人所在院系：</h2>
                    </div>
                    <div class="col-sm-2">
                        <h2 class="text-left">{{ $profile->college->mc }}</h2>
                    </div>
                    <div class="col-sm-2 col-sm-offset-4">
                        <h2 class="text-right">填表日期：</h2>
                    </div>
                    <div class="col-sm-2">
                        <h2 class="text-left">{{ date('Y-m-d', strtotime($project->cjsj)) }}</h2>
                    </div>
                </div>

                <div class="space-line">&nbsp;</div>
                <div class="space-line">&nbsp;</div>
                <div class="space-line">&nbsp;</div>
                <div class="space-line">&nbsp;</div>
                <div class="space-line">&nbsp;</div>

                <div class="row">
                    <div class="col-sm-4 col-sm-offset-4">
                        <h2 class="text-center">广西壮族自治区教育厅</h2>
                    </div>
                </div>
            </article>
        </main>

        <!-- Load JS here for greater good -->
        <script src="{{ asset('js/jquery-1.12.0.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    </body>
</html>