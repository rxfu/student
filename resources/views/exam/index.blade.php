@extends('app')

@section('content')
<section class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="active">考试名称</th>
                                <th class="active">考试时间</th>
                                <th class="active">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($exams as $exam)
                            <tr>
                            	<td>{{ $exam->ksmc }}</td>
                            	<td>{{ $exam->sj }}</td>
                            	<td>
                            		<a href="{{ url('exam/register', $exam->kslx) }}" title="报名" class="btn btn-primary">报名</a>
                            	</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@stop