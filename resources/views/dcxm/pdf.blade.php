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
                font-size: 14pt;
            }
            h1 {
                font-size: 32pt;
                font-weight: bold;
                line-height: 48pt;
            }
            h2 {
                font-size: 26pt;
                font-weight: bold;
                line-height: 39pt;
            }
            h3, .intro p {
                font-size: 18pt;
                font-family: STFangsong, FangSong, SimSun;
                line-height: 27pt;
            }
            p {
                text-indent: 2em;
            }
            .space-line {
                line-height: 28pt;
            }
            .page {
                overflow: hidden;
                page-break-after: always;
                page-break-inside: avoid;
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

            <article class="page">
                <div class="space-line">&nbsp;</div>
                <div class="space-line">&nbsp;</div>

                <header class="row">
                    <div class="col-sm-12">
                        <h1 class="text-center">广西高校大学生创新创业<br>计划项目申报书</h1>
                    </div>
                </header>

                <div class="space-line">&nbsp;</div>
                <div class="space-line">&nbsp;</div>
                <div class="space-line">&nbsp;</div>
                <div class="space-line">&nbsp;</div>
                <div class="space-line">&nbsp;</div>

                <div class="row">
                    <div class="col-xs-8 col-xs-offset-2 text-center">
                        <h3 class="text-left">项目名称：{{ $project->xmmc }}</h3>
                        <h3 class="text-left">项目类别：{{ $project->category->mc }}</h3>
                        <h3 class="text-left">项目负责人：{{ $project->student->xm }}</h3>
                        <h3 class="text-left">负责人所在院系：{{ $project->student->college->mc }}</h3>
                        <h3 class="text-left">填表日期：{{ date('Y-m-d', strtotime($project->cjsj)) }}</h3>
                    </div>
                </div>

                <div class="space-line">&nbsp;</div>
                <div class="space-line">&nbsp;</div>
                <div class="space-line">&nbsp;</div>
                <div class="space-line">&nbsp;</div>
                <div class="space-line">&nbsp;</div>

                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="text-center">广西壮族自治区教育厅</h3>
                    </div>
                </div>
            </article>

            <article class="page">
                <header class="row">
                    <div class="col-sm-12">
                        <h2 class="text-center">填写须知</h2>
                    </div>
                </header>

                <div class="space-line">&nbsp;</div>
                <div class="space-line">&nbsp;</div>

                <div class="row">
                    <div class="col-sm-12 intro">
                        <p>一、项目类别说明：</p>
                        <p>1. 创新训练项目是本科生个人或团队，在导师指导下，自主完成创新性研究项目设计、研究条件准备和项目实施、研究报告撰写、成果（学术）交流等工作。每个项目参与学生一般不超过5人。</p>
                        <p>2. 创业训练项目是本科生团队，在导师指导下，团队中每个学生在项目实施过程中扮演一个或多个具体角色，完成编制商业计划书、开展可行性研究、模拟企业运行、参加企业实践、撰写创业报告等工作。每个项目参与学生一般不超过6人。</p>
                        <p>3. 创业实践项目是学生团队在学校导师和企业导师共同指导下，采用前期创新训练项目（或创新性实验）的成果，提出一项具有市场前景的创新性产品或者服务，以此为基础开展创业实践活动。此类项目不限参与学生人数。</p>
                        <p>二、本表由申请人如实填写，表达简明扼要。</p>
                        <p>三、填表字体用小四号宋体，单倍行距，要求统一用A4纸双面印制、装订。</p>
                    </div>
                </div>
            </article>

            <article class="page">
                <table class="table table-bordered">
                    <tr>
                        <td colspan="2">项目名称</td>
                        <td colspan="5" class="text-center">{{ $project->xmmc }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-nowrap">项目起止时间</td>
                        <td colspan="5" class="text-center">{{ date('Y年m月', strtotime($project->kssj)) }}至{{ date('Y年m月', strtotime($project->kssj)) }}</td>
                    </tr>
                    <tr>
                        <td rowspan="2" width="22">负责人</td>
                        <td class="text-center">姓名</td>
                        <td class="text-center">年级</td>
                        <td class="text-center">所在院系</td>
                        <td class="text-center">学号</td>
                        <td class="text-center">联系电话</td>
                        <td class="text-center">项目中的分工</td>
                    </tr>
                    @for ($i = 0; $i < 5; $i++)
                        <tr>
                            @if (1 == $i)
                                <td rowspan="4">项目组成员</td>
                            @endif
                            @if (isset($project->members[$i]))
                                <?php $member = $project->members[$i];?>
                                @if ($member->sfbx)
                                    <td class="text-center">{{ $member->profile->xm }}</td>
                                    <td class="text-center">{{ $member->profile->nj }}</td>
                                    <td class="text-center">{{ $member->profile->college->mc }}</td>
                                    <td class="text-center">{{ $member->profile->xh }}</td>
                                    <td class="text-center">{{ $member->profile->lxdh }}</td>
                                    <td class="text-center">{{ $member->fg }}</td>
                                @else
                                    <td class="text-center">{{ $member->xm }}</td>
                                    <td class="text-center">{{ $member->nj }}</td>
                                    <td class="text-center">{{ $member->szyx }}</td>
                                    <td class="text-center">{{ $member->xh }}</td>
                                    <td class="text-center">{{ $member->lxdh }}</td>
                                    <td class="text-center">{{ $member->fg }}</td>
                                @endif
                            @else
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            @endif
                        </tr>
                    @endfor

                    @for ($i = 0; $i < 2; $i++)
                        @if (isset($project->bxtutors[$i]))
                            <?php $tutor = $project->bxtutors[$i];?>
                            <tr>
                                @if (0 == $i)
                                    <td rowspan="6">校内指导教师</td>
                                @endif
                                <td>姓名</td>
                                <td colspan="2" class="text-center">{{ $tutor->teacher->xm }}</td>
                                <td>职务/职称</td>
                                <td colspan="2" class="text-center">{{ $tutor->teacher->position->mc }}</td>
                            </tr>
                            <tr>
                                <td colspan="2">所在单位</td>
                                <td colspan="4" class="text-center">{{ $tutor->teacher->department->mc }}</td>
                            </tr>
                            <tr>
                                <td colspan="2">联系电话</td>
                                <td class="text-center">{{ $tutor->teacher->lxdh }}</td>
                                <td>Email</td>
                                <td colspan="2" class="text-center">{{ $tutor->teacher->email }}</td>
                            </tr>
                        @else
                            <tr>
                                <td>姓名</td>
                                <td colspan="2">&nbsp;</td>
                                <td>职务/职称</td>
                                <td colspan="2">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="2">所在单位</td>
                                <td colspan="4">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="2">联系电话</td>
                                <td>&nbsp;</td>
                                <td>Email</td>
                                <td colspan="2">&nbsp;</td>
                            </tr>
                        @endif
                    @endfor

                    @for ($i = 0; $i < 2; $i++)
                        @if (isset($project->wxtutors[$i]))
                            <?php $tutor = $project->wxtutors[$i];?>
                            <tr>
                                @if (0 == $i)
                                    <td rowspan="6">校外指导教师</td>
                                @endif
                                <td>姓名</td>
                                <td colspan="2" class="text-center">{{ $tutor->xm }}</td>
                                <td>职务/职称</td>
                                <td colspan="2" class="text-center">{{ $tutor->zc }}</td>
                            </tr>
                            <tr>
                                <td colspan="2">所在单位</td>
                                <td colspan="4" class="text-center">{{ $tutor->szdw }}</td>
                            </tr>
                            <tr>
                                <td colspan="2">联系电话</td>
                                <td class="text-center">{{ $tutor->lxdh }}</td>
                                <td>Email</td>
                                <td colspan="2" class="text-center">{{ $tutor->email }}</td>
                            </tr>
                        @else
                            <tr>
                                <td>姓名</td>
                                <td colspan="2">&nbsp;</td>
                                <td>职务/职称</td>
                                <td colspan="2">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="2">所在单位</td>
                                <td colspan="4">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="2">联系电话</td>
                                <td>&nbsp;</td>
                                <td>Email</td>
                                <td colspan="2">&nbsp;</td>
                            </tr>
                        @endif
                    @endfor
                </table>
            </article>
        </main>

        <!-- Load JS here for greater good -->
        <script src="{{ asset('js/jquery-1.12.0.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    </body>
</html>