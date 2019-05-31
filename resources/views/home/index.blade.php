@extends('app')

@section('content')
<section class="row">
    <div class="col-sm-12">
    	<div class="panel panel-default">
    		<div class="panel-body">
            <p>{{ $message }}</p>
            @if (!$broadcasts->isEmpty())
                重要提示：
                <ol>
                @foreach ($broadcasts as $broadcast)
                    <li>{{ $broadcast }}</li>
                @endforeach
                </ol>
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
                                <td>{{ $cfxx->cfrq->addMonth($cfxx->cfqx)->format('Y-m-d') }}</td>
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
    		</div>
    	</div>
    </div>
</section>
@stop