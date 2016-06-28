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
                                <th colspan="2" class="active">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($exams as $exam)
                            <tr>
                            	<td>{{ $exam->ksmc }}</td>
                            	<td>{{ $exam->sj }}</td>
                            	<td>
                            		<a href="{{ route('exam.register', $exam->kslx) }}" title="报名" class="btn btn-primary">报名</a>
                                </td>
                                <td>
                                    @if ($exam->is_registered)
                                        <form id="registerForm" name="registerForm" method="post" action="{{ route('exam.destroy', $exam->kslx) }}" role="form">
                                            {!! method_field('delete') !!}
                                            {!! csrf_field() !!}
                                            <button type="submit" class="btn btn-danger">取消报名</button>
                                        </form>
                                    @endif
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