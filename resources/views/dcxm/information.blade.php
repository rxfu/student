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
                    <table id="xmcy-table" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="active"><em>#</em></th>
                                <th class="active">是否本校本科生</th>
                                <th class="active">学号</th>
                                <th class="active">姓名</th>
                                <th class="active">年级</th>
                                <th class="active">所在院系</th>
                                <th class="active">联系电话</th>
                                <th class="active">项目中的分工</th>
                                <th class="active">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><em>1</em></td>
                                <td>是</td>
                                <td>{{ Auth::user()->xh }}</td>
                                <td>{{ Auth::user()->profile->xm }}</td>
                                <td>{{ Auth::user()->profile->nj }}</td>
                                <td>{{ Auth::user()->profile->college->mc }}</td>
                                <td>{{ Auth::user()->profile->lxdh }}</td>
                                <td>
                                    <input type="text" class="form-control" id="fg" name="fg[]">
                                </td>
                                <td>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <button type="button" title="增加" class="btn btn-success cy-add"><i class="fa fa-plus"></i></button>
                                        </span>
                                    </div>
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
                    <table id="zdjs-table" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="active"><em>#</em></th>
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
                                <td><em>1</em></td>
                                <td>是</td>
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
                                    <button type="button" title="增加" class="btn btn-success js-add"><i class="fa fa-plus"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <div class="form-group">
        <div class="col-sm-2 col-sm-offset-5">
            <button type="submit" class="btn btn-primary btn-block btn-lg">保存</button>
        </div>
    </div>
</form>
@stop

@push('scripts')
<script>
$(function() {
    $('#xmcy-table').on('click', '.cy-add', function() {
        $(this).closest('tr').after('\
            <tr>\
                <td></td>\
                <td>\
                    <input type="checkbox" name="cysfbx[]" data-on-text="是" data-off-text="否" checked>\
                </td>\
                <td>\
                    <input type="text" class="form-control" name="xh[]">\
                </td>\
                <td>\
                    <span class="xm"></span>\
                </td>\
                <td>\
                    <span class="nj"></span>\
                </td>\
                <td>\
                    <span class="szyx"></span>\
                </td>\
                <td>\
                    <span class="lxdh"></span>\
                </td>\
                <td>\
                    <input type="text" class="form-control" id="fg" name="fg[]">\
                </td>\
                <td>\
                    <div class="input-group">\
                        <span class="input-group-btn">\
                            <button type="button" title="增加" class="btn btn-success cy-add"><i class="fa fa-plus"></i></button>\
                            <button type="button" title="减少" class="btn btn-danger cy-remove"><i class="fa fa-minus"></i></button>\
                        </span>\
                    </div>\
                </td>\
            </tr>\
        ');

        $('#xmcy-table tr').each(function(index) {
            $(this).children('td:eq(0)').html('<em>' + index + '</em>');
        });

        $('input[name="cysfbx[]"]').bootstrapSwitch({
            onSwitchChange: function(event, state) {
                var row = $(this).closest('tr');

                if (true == state) {
                    row.find('td').slice(3, 7).children().remove();
                } else {
                    row.find('td:eq(3)').append('<input type="text" class="form-control" name="xm[]">');
                    row.find('td:eq(4)').append('<input type="text" class="form-control" name="nj[]">');
                    row.find('td:eq(5)').append('<input type="text" class="form-control" name="szyx[]]">');
                    row.find('td:eq(6)').append('<input type="text" class="form-control" name="lxdh[]">');
                }
            }
        });
    });

    $('#xmcy-table').on('click', '.cy-remove', function() {
        $(this).closest('tr').remove();

        $('#xmcy-table tr').each(function(index) {
            $(this).children('td:eq(0)').html('<em>' + index + '</em>');
        });
    });

    $('#zdjs-table').on('click', '.js-add', function() {
        $(this).closest('tr').after('\
            <tr>\
                <td></td>\
                <td>\
                    <input type="checkbox" name="jssfbx[]" data-on-text="是" data-off-text="否" checked>\
                </td>\
                <td>\
                    <input type="text" class="form-control" name="jsgh[]">\
                </td>\
                <td>\
                    <span class="xm"></span>\
                </td>\
                <td>\
                    <span class="zc"></span>\
                </td>\
                <td>\
                    <span class="xzdw"></span>\
                </td>\
                <td>\
                    <span class="lxdh"></span>\
                </td>\
                <td>\
                    <span class="email"></span>\
                </td>\
                <td>\
                    <div class="input-group">\
                        <span class="input-group-btn">\
                            <button type="button" title="增加" class="btn btn-success js-add"><i class="fa fa-plus"></i></button>\
                            <button type="button" title="减少" class="btn btn-danger js-remove"><i class="fa fa-minus"></i></button>\
                        </span>\
                    </div>\
                </td>\
            </tr>\
        ');

        $('#zdjs-table tr').each(function(index) {
            $(this).children('td:eq(0)').html('<em>' + index + '</em>');
        });

        $('input[name="jssfbx[]"]').bootstrapSwitch({
            onSwitchChange: function(event, state) {
                var row = $(this).closest('tr');

                if (true == state) {
                    row.find('td').slice(3, 8).children().remove();
                } else {
                    row.find('td:eq(3)').append('<input type="text" class="form-control" name="xm[]">');
                    row.find('td:eq(4)').append('<input type="text" class="form-control" name="zc[]">');
                    row.find('td:eq(5)').append('<input type="text" class="form-control" name="szdw[]]">');
                    row.find('td:eq(6)').append('<input type="text" class="form-control" name="lxdh[]">');
                    row.find('td:eq(7)').append('<input type="text" class="form-control" name="email[]">');
                }
            }
        });
    });

    $('#zdjs-table').on('click', '.js-remove', function() {
        $(this).closest('tr').remove();

        $('#zdjs-table tr').each(function(index) {
            $(this).children('td:eq(0)').html('<em>' + index + '</em>');
        });
    });
});
</script>
@endpush