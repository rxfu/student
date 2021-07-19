@extends('app')

@section('content')
<section class="row">
    <div class="col-sm-12">
    	<div class="panel panel-default">
    		<div class="panel-body">
                <div class="bs-callout bs-callout-danger">
                    <h4>重要提示</h4>
                    <p>{{ $message}}</p>
                </div>
                @if (!$broadcasts->isEmpty())
                    @foreach ($broadcasts as $broadcast)
                        <div class="bs-callout bs-callout-info">
                            <h4>公共消息</h4>
                            <p>{{ $broadcast->text }}</p>
                        </div>
                    @endforeach
                @endif
                @if (!$cfxxs->isEmpty())
                    <table class="table table-striped table-bordered">
                        <caption>
                            <h3>处分信息</h3>
                        </caption>
                        <thead>
                            <tr>
                                <th>学号</th>
                                <th>姓名</th>
                                <th>政治面貌</th>
                                <th>处分种类</th>
                                <th>处分期限</th>
                                <th>处分日期</th>
                                <th>处分到期日</th>
                                <th>处分文号</th>
                                <th>处分文件名</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cfxxs as $cfxx)
                                <tr>
                                    <td>{{ $cfxx->xh }}</td>
                                    <td>{{ is_null($cfxx->profile) ? '' : $cfxx->profile->xm }}</td>
                                    <td>{{ is_null($cfxx->profile->party) ? '' : $cfxx->profile->party->mc }}</td>
                                    <td>{{ is_null($cfxx->jg) ? '' : $cfxx->jg->mc }}</td>
                                    <td>{{ $cfxx->cfqx }}</td>
                                    <td>{{ $cfxx->cfrq->format('Y-m-d') }}</td>
                                    <td>{{ $cfxx->cfrq->addMonth($cfxx->cfqx)->subDays(1)->format('Y-m-d') }}</td>
                                    <td>{{ $cfxx->cfwh }}</td>
                                    <td>{{ $cfxx->cfwjmc }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <ul>
                        <li>
                            根据《广西师范大学学生违纪处分办法》第八条规定，处分可按期或提前解除，请在处分期满前一星期将《广西师范大学学生解除处分申请表》及相关材料交到教务处学籍管理科。联系电话：07735845849
                        </li>
                        <li>
                            《广西师范大学学生解除处分申请表》下载地址：<a href="http://www.dean.gxnu.edu.cn/2018/0613/c3234a60145/page.htm">http://www.dean.gxnu.edu.cn/2018/0613/c3234a60145/page.htm</a>
                        </li>
                    </ul>
                @endif
                @if (!$bymds->isEmpty())
                    <blockquote>
                        <p>特别提示：毕业预审主要用于预先审核学生毕业情况，审核标准为默认学生已获得第八学期所选课程的学分，此前学期则以实际获得的学分数进行统计（待确认成绩的课程学分未计入）。</p>
                        <p>毕业正式审核开启后，毕业预审结论自动作废，审核标准以学生实际已获得的学分为准。 </p>
                    </blockquote>
                    <table class="table table-striped table-bordered">
                        <caption>
                            <h3>毕业情况</h3>
                        </caption>
                        <thead>
                            <tr>
                                <th>学号</th>
                                <th>姓名</th>
                                <th>审核时间</th>
                                <th>审核阶段</th>
                                <th>审核结果</th>
                                <th>审核不通过原因</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $bymds[0]->xh }}</td>
                                <td>{{ $bymds[0]->xm }}</td>
                                <td>{{ $bymds[0]->pc }}</td>
                                <td>
                                    @if (-1 == $bymds[0]->jd)
                                        预审
                                    @elseif (0 == $bymds[0]->jd)
                                        正式审核
                                    @endif
                                </td>
                                <td>{{ $bymds[0]->byflzd->mc }}</td>
                                <td>{{ $bymds[0]->yy }}</td>
                            </tr>
                        </tbody>
                    </table>
                @endif
                @if (!$byxwpds->isEmpty())
                    <table class="table table-striped table-bordered">
                        <caption>
                            <h3>学位评定情况</h3>
                        </caption>
                        <thead>
                            <tr>
                                <th>学号</th>
                                <th>姓名</th>
                                <th>审核时间</th>
                                <th>审核阶段</th>
                                <th>学院评定意见</th>
                                <th>审核不通过原因</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $byxwpds[0]->xh }}</td>
                                <td>{{ $byxwpds[0]->xm }}</td>
                                <td>{{ $byxwpds[0]->pc }}</td>
                                <td>
                                    @if (-1 == $byxwpds[0]->jd)
                                        预审
                                    @elseif (0 == $byxwpds[0]->jd)
                                        正式审核
                                    @endif
                                </td>
                                <td>
                                    @if ('Y' == trim($byxwpds[0]->xjg))
                                        同意
                                    @elseif ('N' == trim($byxwpds[0]->xjg))
                                        不同意
                                    @endif
                                </td>
                                <td>{{ $byxwpds[0]->yy }}</td>
                            </tr>
                        </tbody>
                    </table>
                @endif
    		</div>
    	</div>
    </div>
</section>
@stop