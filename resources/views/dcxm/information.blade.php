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
                    <table id="xmcy" class="table table-bordered table-striped table-hover">
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
                                <td>{{ Auth::user()->xh }}</td>
                                <td>{{ Auth::user()->profile->xm }}</td>
                                <td>{{ Auth::user()->profile->nj }}</td>
                                <td>{{ Auth::user()->profile->college->mc }}</td>
                                <td>{{ Auth::user()->profile->lxdh }}</td>
                                <td>
                                    <input type="text" class="form-control" id="fg" name="fg">
                                </td>
                                <td>
                                    <input type="checkbox" name="sfbx" data-on-text="是" data-off-text="否" readonly checked>
                                </td>
                                <td>
                                    <a href="#" title="增加" role="button" class="cy-plus"><i class="fa fa-plus text-success"></i></a>
                                    <a href="#" title="减少" role="button" class="cy-minus"><i class="fa fa-minus text-danger"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>成员</td>
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
                                    <input type="checkbox" name="sfbx" data-on-text="是" data-off-text="否" checked>
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
    $('input[name="sfbx"]').bootstrapSwitch();
    $('input[name="sfbx"]').on('switchChange.bootstrapSwitch', function(event, state) {
        var row = $(this).closest('tr');

        if (true == state) {
            row.find('td').slice(2, 6).children().remove();
        } else {
            row.find('td:eq(2)').append('<input type="text" class="form-control" id="xm" name="xm">');
            row.find('td:eq(3)').append('<input type="text" class="form-control" id="nj" name="nj">');
            row.find('td:eq(4)').append('<input type="text" class="form-control" id="szyx" name="szyx">');
            row.find('td:eq(5)').append('<input type="text" class="form-control" id="lxdh" name="lxdh">');
        }
    });
    $('td').on('click', '.cy-plus', function() {
        $('#xmcy tbody tr:last').after('\
            <tr>\
                <td>成员</td>\
                <td>\
                    <input type="text" class="form-control" id="xh" name="xh">\
                </td>\
                <td>\
                    <input type="text" class="form-control" id="xm" name="xm">\
                </td>\
                <td>\
                    <input type="text" class="form-control" id="nj" name="nj">\
                </td>\
                <td>\
                    <input type="text" class="form-control" id="szyx" name="szyx">\
                </td>\
                <td>\
                    <input type="text" class="form-control" id="lxdh" name="lxdh">\
                </td>\
                <td>\
                    <input type="text" class="form-control" id="fg" name="fg">\
                </td>\
                <td>\
                    <input type="checkbox" name="sfbx" data-on-text="是" data-off-text="否" checked>\
                </td>\
                <td>\
                    <a href="#" title="增加" role="button" class="cy-plus"><i class="fa fa-plus text-success"></i></a>\
                    <a href="#" title="减少" role="button" class="cy-minus"><i class="fa fa-minus text-danger"></i></a>\
                </td>\
            </tr>\
        ');
    });
    $('td').on('click', '.cy-minus', function() {
        $(this).closest('tr').remove();
    });
});
</script>
@endpush