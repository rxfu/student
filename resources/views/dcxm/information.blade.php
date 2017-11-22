@extends('app')

@section('content')
<form id="appForm" name="appForm" method="post" action="{{ url('dcxm/xmxx') }}" class="form-horizontal">
    {!! csrf_field() !!}
    <section class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">项目基本信息</div>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="xmmc" class="col-sm-3 control-label">项目名称</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="xmmc" name="xmmc">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="xmlb_dm" class="col-sm-3 control-label">项目类别</label>
                        <div class="col-sm-8">
                            <select name="xmlb_dm" id="xmlb_dm" class="form-control">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->dm }}">{{ $category->mc }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="yjxk_dm" class="col-sm-3 control-label">所属一级学科</label>
                        <div class="col-sm-8">
                            <select name="yjxk_dm" id="yjxk_dm" class="form-control">
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->dm }}">{{ $subject->mc }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kssj" class="col-sm-3 control-label">项目起始时间</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="kssj" name="kssj">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jssj" class="col-sm-3 control-label">项目结束时间</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="jssj" name="jssj">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">项目组成员</div>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="active">身份</th>
                                <th class="active">学号</th>
                                <th class="active">姓名</th>
                                <th class="active">年级</th>
                                <th class="active">所在院系</th>
                                <th class="active">联系电话</th>
                                <th class="active">项目中的分工</th>
                                <th class="active">是否本校本科生</th>
                                <th class="active">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>负责人</td>
                                <td>
                                    <a href="#" title="增加" role="button"><i class="fa fa-plus text-success"></i></a>
                                    <a href="#" title="减少" role="button"><i class="fa fa-minus text-danger"></i></a>
                                </td>
                                <td>{{ Auth::user()->xh }}</td>
                                <td>{{ Auth::user()->profile->xm }}</td>
                                <td>{{ Auth::user()->profile->nj }}</td>
                                <td>{{ Auth::user()->profile->college->mc }}</td>
                                <td>{{ Auth::user()->profile->lxdh }}</td>
                                <td>
                                    <input type="text" class="form-control" id="fg" name="fg">
                                </td>
                                <td>
                                    <select id="sfbx" name="sfbx">
                                        <option value="1" selected>是</option>
                                        <option value="0">否</option>
                                    </select>
                                </td>
                                <td>
                                    <a href="#" title="增加" role="button"><i class="fa fa-plus text-success"></i></a>
                                    <a href="#" title="减少" role="button"><i class="fa fa-minus text-danger"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>成员</td>
                                <td>
                                    <a href="#" title="增加" role="button"><i class="fa fa-plus text-success"></i></a>
                                    <a href="#" title="减少" role="button"><i class="fa fa-minus text-danger"></i></a>
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="xh" name="xh">
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="xm" name="xm">
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="nj" name="nj">
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="szyx" name="szyx">
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="lxdh" name="lxdh">
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="fg" name="fg">
                                </td>
                                <td>
                                    <select id="sfbx" name="sfbx">
                                        <option value="1" selected>是</option>
                                        <option value="0">否</option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <section class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">指导教师</div>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="active">是否本校教师</th>
                                <th class="active">工号</th>
                                <th class="active">姓名</th>
                                <th class="active">职称</th>
                                <th class="active">所在单位</th>
                                <th class="active">联系电话</th>
                                <th class="active">Email</th>
                                <th class="active">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select id="sfbx" name="sfbx">
                                        <option value="1" selected>是</option>
                                        <option value="0">否</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="jsgh" name="jsgh">
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="xm" name="xm">
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="zc" name="zc">
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="szdw" name="szdw">
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="lxdh" name="lxdh">
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="email" name="email">
                                </td>
                                <td>
                                    <a href="#" title="增加" role="button"><i class="fa fa-plus text-success"></i></a>
                                    <a href="#" title="减少" role="button"><i class="fa fa-minus text-danger"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <div class="form-group">
        <div class="col-sm-8 col-sm-offset-3">
            <button type="submit" class="btn btn-primary">保存</button>
        </div>
    </div>
</form>
@stop

@push('scripts')
<script>
$(function() {
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