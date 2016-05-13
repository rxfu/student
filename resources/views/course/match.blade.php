@extends('app')

@section('content')
<section class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="active">课程号</th>
                                <th class="active">课程名称</th>
                                <th class="active">计划学分</th>
                                <th class="active">选课学分</th>
                                <th class="active">成绩学分</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>课程号</th>
                                <th>课程名称</th>
                                <th>计划学分</th>
                                <th>选课学分</th>
                                <th>成绩学分</th>
                            </tr>
                        </tfoot>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@stop