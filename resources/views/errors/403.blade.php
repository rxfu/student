@extends('app')

@section('content')
<section class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <h1 class="text-center">403 - 未授权页面</h1>
                <h3 class="text-center">通知：{{ isset($exception) ? $exception->getMessage() : '未知消息' }}</h3>
            </div>
        </div>
    </div>
</section>
@stop