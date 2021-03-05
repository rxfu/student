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
                    <div class="form-group">
                        <label for="nj" class="col-sm-2 control-label">开课年级</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="nj" name="nj" value="{{ $nj }}" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kkxy" class="col-sm-2 control-label">开课学院</label>
                        <div class="col-sm-4">
                            <p class="form-control-static">{{ App\Models\Department::findOrFail($kkxy)->mc }}</p>
                            <input type="hidden" id="kkxy" name="kkxy" value="{{ $kkxy }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="zy" class="col-sm-2 control-label">开课专业</label>
                        <div class="col-sm-4">
                            <p class="form-control-static">{{ App\Models\Major::findOrFail($zy)->mc }}</p>
                            <input type="hidden" id="zy" name="zy" value="{{ $zy }}">
                        </div>
                    </div>
                    @if ('retake' == $type)
                        <div class="form-group">
                            <label for="ykcxh" class="col-sm-2 control-label">原课程</label>
                            <div class="col-sm-4">
                                <select name="ykcxh" id="ykcxh" class="form-control">
                                    @if (1 == count($courses))
                                        <option value="{{ $courses[0]->kcxh }}" data-ynd="{{ $courses[0]->nd }}" data-yxq="{{ $courses[0]->xq }}" data-yxqmc="{{ $courses[0]->term->mc }}" data-yxf="{{ $courses[0]->xf }}">{{ $courses[0]->kcxh }} - {{ $courses[0]->course->kcmc }}</option>
                                    @else
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->kcxh }}" data-ynd="{{ $course->nd }}" data-yxq="{{ $course->xq }}" data-yxqmc="{{ $course->term->mc }}" data-yxf="{{ $course->xf }}">{{ $course->kcxh }} - {{ $course->course->kcmc }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ynd" class="col-sm-2 control-label">原年度</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="ynd" name="ynd" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="yxq" class="col-sm-2 control-label">原学期</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="yxqmc" name="yxqmc" readonly>
                                <input type="hidden" id="yxq" name="yxq" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="yxf" class="col-sm-2 control-label">原学分</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="yxf" name="yxf" readonly>
                            </div>
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
    @if (('retake' == $type) && (1 < count($courses)))
        alert('在已选课程中未找到原课程，如果确认需要进行重修申请，请在提示结束后手工选择原课程。特别提示：原课程与重修课程不一致会导致重修申请被拒绝，请提交申请后与教学秘书联系并确认。');
    @endif

    $('#ynd').val($('#ykcxh option:selected').attr('data-ynd'));
    $('#yxq').val($('#ykcxh option:selected').attr('data-yxq'));
    $('#yxqmc').val($('#ykcxh option:selected').attr('data-yxqmc'));
    $('#yxf').val($('#ykcxh option:selected').attr('data-yxf'));

    $('#ykcxh').change(function() {
        $('#ynd').val($('#ykcxh option:selected').attr('data-ynd'));
        $('#yxq').val($('#ykcxh option:selected').attr('data-yxq'));
        $('#yxqmc').val($('#ykcxh option:selected').attr('data-yxqmc'));
        $('#yxf').val($('#ykcxh option:selected').attr('data-yxf'));
    });
});
</script>
@endpush