@extends('app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">请{{ Auth::user()->profile->xm }}同学输入监护人信息</div>
            </div>
            <div class="panel-body">
                <form role="form" id="fmxxForm" name="fmxxForm" class="form-horizontal" method="POST" action="{{ url('/parent') }}" aria-label="监护人信息录入">
                    {!! csrf_field() !!}
                    <fieldset>
                        <div class="form-group">
                            <label for="xh" class="col-md-3 control-label">学号</label>
                            <div class="col-md-8">
                                <input type="text" id="xh" name="xh" class="form-control" value="{{ Auth::user()->profile->xh }}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="xm" class="col-md-3 control-label">姓名</label>
                            <div class="col-md-8">
                                <input type="text" id="xm" name="xm" class="form-control" value="{{ Auth::user()->profile->xm }}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="zjlx" class="col-md-3 control-label">身份证件类型</label>
                            <div class="col-md-8">
                                <input type="text" id="zjlx" name="zjlx" class="form-control" value="{{ Auth::user()->profile->idtype->mc }}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="zjhm" class="col-md-3 control-label">身份证件号码</label>
                            <div class="col-md-8">
                                <input type="text" id="zjhm" name="zjhm" class="form-control" value="{{ Auth::user()->profile->sfzh }}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sfzz" class="col-md-3 control-label">是否在职</label>
                            <div class="col-md-8">
                                否
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="rxrq" class="col-md-3 control-label">入学日期</label>
                            <div class="col-md-8">
                                <input type="text" id="rxrq" name="rxrq" class="form-control" value="{{ str_replace('-', '', Auth::user()->profile->rxrq) }}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="xjzt" class="col-md-3 control-label">学籍状态</label>
                            <div class="col-md-8">
                                <input type="text" id="xjzt" name="xjzt" class="form-control" value="{{ Auth::user()->profile->status->mc }}" readonly>
                            </div>
                        </div>
                        <div class="form-group has-feedback{{ $errors->has('fmxm1') ? ' has-error' : '' }}">
                            <label for="fmxm1" class="col-md-3 control-label">父母或监护人姓名1</label>
                            <div class="col-md-8">
                                <input type="text" id="fmxm1" name="fmxm1" class="form-control" placeholder="父母或监护人姓名1">

                                @if ($errors->has('fmxm1'))
                                    <span class="help-block" role="alert">
                                        <strong>{{ $errors->first('fmxm1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="fmzjlx1" class="col-md-3 control-label">父母或监护人证件类型1</label>
                            <div class="col-md-8">
                                <select id="fmzjlx1" name="fmzjlx1" class="form-control">
                                    @foreach ($types as $type)
                                        <option value="{{ $type }}">{{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group has-feedback{{ $errors->has('fmzjhm1') ? ' has-error' : '' }}">
                            <label for="fmzjhm1" class="col-md-3 control-label">父母或监护人证件号码1</label>
                            <div class="col-md-8">
                                <input type="text" id="fmzjhm1" name="fmzjhm1" class="form-control" placeholder="父母或监护人证件号码1">

                                @if ($errors->has('fmzjhm1'))
                                    <span class="help-block" role="alert">
                                        <strong>{{ $errors->first('fmzjhm1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group has-feedback{{ $errors->has('fmxm2') ? ' has-error' : '' }}">
                            <label for="fmxm2" class="col-md-3 control-label">父母或监护人姓名2</label>
                            <div class="col-md-8">
                                <input type="text" id="fmxm2" name="fmxm2" class="form-control" placeholder="父母或监护人姓名2">

                                @if ($errors->has('fmxm2'))
                                    <span class="help-block" role="alert">
                                        <strong>{{ $errors->first('fmxm2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="fmzjlx2" class="col-md-3 control-label">父母或监护人证件类型2</label>
                            <div class="col-md-8">
                                <select id="fmzjlx2" name="fmzjlx2" class="form-control">
                                    @foreach ($types as $type)
                                        <option value="{{ $type }}">{{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group has-feedback{{ $errors->has('fmzjhm2') ? ' has-error' : '' }}">
                            <label for="fmzjhm2" class="col-md-3 control-label">父母或监护人证件号码2</label>
                            <div class="col-md-8">
                                <input type="text" id="fmzjhm2" name="fmzjhm2" class="form-control" placeholder="父母或监护人证件号码2">

                                @if ($errors->has('fmzjhm2'))
                                    <span class="help-block" role="alert">
                                        <strong>{{ $errors->first('fmzjhm2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-3">
                                <button type="submit" class="btn btn-primary">确定</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
