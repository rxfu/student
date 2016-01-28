@extends('app')

@section('content')
	@if (empty($scores))
        <section class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body bg-warning">
                        <h3 class="text-center">无成绩单</h3>
                    </div>
                </div>
            </div>
        </section>
    @else
        <section class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover data-table">
                                <thead>
                                    <tr>
                                        <th class="active">考试时间</th>
                                        <th class="active">考试名称</th>
                                        <th class="active">考试成绩</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($scores as $score)
                                    <tr>
                                        <td>{{ $score->c_kssj }}</td>
                                        <td>{{ $score->ksmc }}</td>
                                        <td>{{ $score->c_cj }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@stop