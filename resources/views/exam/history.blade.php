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
                                <th class="active">报名时间</th>
                                <th class="active">考试类型</th>
                                <th class="active">所在校区</th>
                                <th class="active">考试时间</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($exams as $exam)
                            <tr>
                                <td>{{ $exam->bmsj }}</td>
                                <td>{{ count($exam->type) ? $exam->type->ksmc : '' }}</td>
                                <td>{{ $exam->campus->mc }}</td>
                                <td>{{ $exam->kssj }}</td>
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