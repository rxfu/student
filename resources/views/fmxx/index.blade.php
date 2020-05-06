@extends('app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title text-center">
                    <strong>请{{ Auth::user()->profile->xm }}同学核对个人信息并自愿填报父母或监护人信息</strong>
                </div>
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
                                <div class="form-control-static">否</div>
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
                            <label for="fmxm1" class="col-md-3 control-label">父母或监护人1姓名</label>
                            <div class="col-md-8">
                                <input type="text" id="fmxm1" name="fmxm1" class="form-control" placeholder="父母或监护人1姓名" value="{{ old('fmxm1') ? old('fmxm1') : (is_null($parent) ? '' : $parent->fmxm1) }}"{{ is_null($parent) ? '' : ($parent->sfty == '0' ? ' readonly' : '') }}>

                                @if ($errors->has('fmxm1'))
                                    <span class="help-block" role="alert">
                                        <strong>{{ $errors->first('fmxm1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group has-feedback{{ $errors->has('fmzjlx1') ? ' has-error' : '' }}">
                            <label for="fmzjlx1" class="col-md-3 control-label">父母或监护人1身份证件类型</label>
                            <div class="col-md-8">
                                <select id="fmzjlx1" name="fmzjlx1" class="form-control"{{ is_null($parent) ? '' : ($parent->sfty == '0' ? ' readonly' : '') }}>
                                    @foreach ($types as $type)
                                        <option value="{{ $type }}"{{ $type == old('fmzjlx1') ? ' selected' : (is_null($parent) ? '' : ($type == $parent->fmzjlx1 ? ' selected' : '')) }}>{{ empty($type) ? '' : $type }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('fmzjlx1'))
                                    <span class="help-block" role="alert">
                                        <strong>{{ $errors->first('fmzjlx1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group has-feedback{{ $errors->has('fmzjhm1') ? ' has-error' : '' }}">
                            <label for="fmzjhm1" class="col-md-3 control-label">父母或监护人1身份证件号码</label>
                            <div class="col-md-8">
                                <input type="text" id="fmzjhm1" name="fmzjhm1" class="form-control" placeholder="父母或监护人1身份证件号码" value="{{ old('fmzjhm1') ? old('fmzjhm1') : (is_null($parent) ? '' : $parent->fmzjhm1) }}"{{ is_null($parent) ? '' : ($parent->sfty == '0' ? ' readonly' : '') }}>

                                @if ($errors->has('fmzjhm1'))
                                    <span class="help-block" role="alert">
                                        <strong>{{ $errors->first('fmzjhm1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group has-feedback{{ $errors->has('fmxm2') ? ' has-error' : '' }}">
                            <label for="fmxm2" class="col-md-3 control-label">父母或监护人2姓名</label>
                            <div class="col-md-8">
                                <input type="text" id="fmxm2" name="fmxm2" class="form-control" placeholder="父母或监护人2姓名" value="{{ old('fmxm2') ? old('fmxm2') : (is_null($parent) ? '' : $parent->fmxm2) }}"{{ is_null($parent) ? '' : ($parent->sfty == '0' ? ' readonly' : '') }}>

                                @if ($errors->has('fmxm2'))
                                    <span class="help-block" role="alert">
                                        <strong>{{ $errors->first('fmxm2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group has-feedback{{ $errors->has('fmzjlx2') ? ' has-error' : '' }}">
                            <label for="fmzjlx2" class="col-md-3 control-label">父母或监护人2身份证件类型</label>
                            <div class="col-md-8">
                                <select id="fmzjlx2" name="fmzjlx2" class="form-control"{{ is_null($parent) ? '' : ($parent->sfty == '0' ? ' readonly' : '') }}>
                                    @foreach ($types as $type)
                                        <option value="{{ $type }}"{{ $type == old('fmzjlx2') ? ' selected' : (is_null($parent) ? '' : ($type == $parent->fmzjlx2 ? ' selected' : '')) }}>{{ empty($type) ? '' : $type }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('fmzjlx2'))
                                    <span class="help-block" role="alert">
                                        <strong>{{ $errors->first('fmzjlx2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group has-feedback{{ $errors->has('fmzjhm2') ? ' has-error' : '' }}">
                            <label for="fmzjhm2" class="col-md-3 control-label">父母或监护人2身份证件号码</label>
                            <div class="col-md-8">
                                <input type="text" id="fmzjhm2" name="fmzjhm2" class="form-control" placeholder="父母或监护人2身份证件号码" value="{{ old('fmzjhm2') ? old('fmzjhm2') : (is_null($parent) ? '' : $parent->fmzjhm2) }}"{{ is_null($parent) ? '' : ($parent->sfty == '0' ? ' readonly' : '') }}>

                                @if ($errors->has('fmzjhm2'))
                                    <span class="help-block" role="alert">
                                        <strong>{{ $errors->first('fmzjhm2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="bz" class="col-md-3 control-label">备注</label>
                            <div class="col-md-8">
                                <textarea id="bz" name="bz" class="form-control" placeholder="备注" rows="5">{{ old('bz') }}</textarea>
                            </div>
                        </div>
                        <div class="form-group has-feedback{{ $errors->has('sfty') ? ' has-error' : '' }}"">
                            <div class="col-md-8 col-md-offset-3">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="sfty" value="1"{{ is_null($parent) ? '' : ($parent->sfty === '1' ? ' checked' : '') }}> 1.本人承诺以上所填报信息真实有效。
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="sfty" value="0"{{ is_null($parent) ? '' : ($parent->sfty === '0' ? ' checked' : '') }}> 2.本人自愿放弃填报父母或监护人的信息。
                                    </label>
                                </div>

                                @if ($errors->has('sfty'))
                                    <span class="help-block" role="alert">
                                        <strong>{{ $errors->first('sfty') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-3">
                                <button type="submit" class="btn btn-primary">确认提交</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function() {
        $('input[name="sfty"]').change(function() {
            if ($(this).val() == '0') {
                $('#fmxm1, #fmzjlx1, #fmzjhm1, #fmxm2, #fmzjlx2, #fmzjhm2').val('').attr('readonly', 'readonly')
            } else {
                $('#fmxm1, #fmzjlx1, #fmzjhm1, #fmxm2, #fmzjlx2, #fmzjhm2').removeAttr('readonly')
            }
        });
    })
</script>
@endpush
