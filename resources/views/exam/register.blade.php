@extends('app')

@section('content')
<section class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label for="sno" class="col-sm-4">学号</label>
                                <div class="col-sm-8">{{ $profile->xh }}</div>
                            </div>
                            <div class="form-group">
                                <label for="sno" class="col-sm-4">姓名</label>
                                <div class="col-sm-8">{{ $profile->xm }}</div>
                            </div>
                            <div class="form-group">
                                <label for="sno" class="col-sm-4">身份证号码</label>
                                <div class="col-sm-8">{{ $profile->sfzh }}</div>
                            </div>
                            <div class="form-group">
                                <label for="sno" class="col-sm-4">考试时间</label>
                                <div class="col-sm-8">{{ $exam->sj }}</div>
                            </div>
                            <div class="form-group">
                                <label for="sno" class="col-sm-4">报考类别</label>
                                <div class="col-sm-8">{{ $exam->ksmc }}</div>
                            </div>
                            <div class="form-group">
                                <label for="cno" class="col-sm-4">所在校区</label>
                                <div class="col-sm-8">{{ $profile->college->pivot->campus->mc }}</div>
                            </div>
                            <form id="registerForm" name="registerForm" method="post" action="{{ route('exam.update', $exam->kslx) }}" role="form">
                            	{!! method_field('put') !!}
                            	{!! csrf_field() !!}
                                <div class="form-group">
                                    <div class="col-sm-8 col-sm-offset-4">
                                        <button type="submit" class="btn btn-primary">报名</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <img src="{{ url('profile/portrait') }}" alt="{{ $profile->xm }}" width="240" class="img-rounded">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop

@push('scripts')
<script>
</script>
@endpush