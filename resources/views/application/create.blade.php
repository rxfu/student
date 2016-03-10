@extends('app')

@section('content')
<section class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <form id="appForm" name="appForm" method="post" action="{{ route('application.store') }}" class="form-horizontal">
                	{!! csrf_field() !!}
                	<input type="hidden" name="type" value="{{ $type }}">
                    <div class="form-group">
                        <label for="kcxh" class="col-sm-2 control-label">课程序号</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="kcxh" name="kcxh" value="{{ $kcxh }}" readonly>
                        </div>
                    </div>
                    @if ('retake' == $type)
                        <div class="form-group">
                            <label for="ykcxh" class="col-sm-2 control-label">原课程</label>
                            <div class="col-sm-4">
                                <select name="ykcxh" id="ykcxh" class="form-control">
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->kcxh }}" data-ynd="{{ $course->nd }}" data-yxq="{{ $course->term->mc }}" data-yxf="{{ $course->xf }}">{{ $course->kcxh }} - {{ $course->course->kcmc }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ynd" class="col-sm-2 control-label">原年度</label>
                            <div class="col-sm-4 form-control-static"><span id="ynd"></span></div>
                        </div>
                        <div class="form-group">
                            <label for="yxq" class="col-sm-2 control-label">原学期</label>
                            <div class="col-sm-4 form-control-static"><span id="yxq"></span></div>
                        </div>
                        <div class="form-group">
                            <label for="yxq" class="col-sm-2 control-label">原学分</label>
                            <div class="col-sm-4 form-control-static"><span id="yxf"></span></div>
                        </div>
                    @endif
                    <div class="form-group">
                        <div class="col-sm-6 col-sm-offset-2">
                            <button type="submit" class="btn btn-primary">提交申请</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@stop

@push('scripts')
<script>
$(function() {
    $('#ykcxh').change(function() {
        $('#ynd').text($('#ykcxh option:selected').attr('data-ynd') + ' 年度');
        $('#yxq').text($('#ykcxh option:selected').attr('data-yxq') + ' 学期');
        $('#yxf').text($('#ykcxh option:selected').attr('data-yxf') + ' 学分');
    });
});
</script>
@endpush