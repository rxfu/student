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
                        <label for="kssj" class="col-sm-3 control-label">项目起止时间</label>
                        <div class="col-sm-8">
                            <div id="datepicker" class="input-daterange input-group">
                                <input type="text" class="form-control" id="kssj" name="kssj">
                                <span class="input-group-addon">至</span>
                                <input type="text" class="form-control" id="jssj" name="jssj">
                            </div>
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
                                <th class="active">排名</th>
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
                                <td>
                                    <input type="text" class="form-control" name="cypm[]" value="1" size="1" readonly>
                                </td>
                                <td>
                                    <input type="checkbox" name="cysfbx[]" data-on-text="是" data-off-text="否" value="true" checked readonly>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="xh[]" value="{{ Auth::user()->xh }}" readonly>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="cyxm[]" value="{{ Auth::user()->profile->xm }}" size="10" readonly>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="nj[]" value="{{ Auth::user()->profile->nj }}" size="4" readonly>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="szyx[]" value="{{ Auth::user()->profile->college->mc }}" readonly>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="cylxdh[]" value="{{ Auth::user()->profile->lxdh }}" readonly>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="fg[]">
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
                                <th class="active">排名</th>
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
                                    <input type="text" class="form-control" name="jspm[]" value="1" size="1" readonly>
                                </td>
                                <td>
                                    <input type="checkbox" name="jssfbx[]" data-on-text="是" data-off-text="否" value="true" checked readonly>
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="jsgh" name="jsgh[]">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="jsxm[]" size="10" readonly>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="zc[]" size="12" readonly>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="szdw[]" readonly>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="jslxdh[]" readonly>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="email[]" readonly>
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
            <button type="submit" class="btn btn-primary btn-block btn-lg">下一步</button>
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
                <td><input type="text" class="form-control" name="cypm[]" size="1" readonly></td>\
                <td><input type="checkbox" name="cysfbx[]" data-on-text="是" data-off-text="否" value="true" checked></td>\
                <td><input type="text" class="form-control" name="xh[]"></td>\
                <td><input type="text" class="form-control" name="cyxm[]" size="10" readonly></td>\
                <td><input type="text" class="form-control" name="nj[]" size="4" readonly></td>\
                <td><input type="text" class="form-control" name="szyx[]" readonly></td>\
                <td><input type="text" class="form-control" name="cylxdh[]" readonly></td>\
                <td><input type="text" class="form-control" name="fg[]"></td>\
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
            $(this).children('td:eq(0)').html('<input type="text" class="form-control" name="cypm[]" size="1" readonly value="' + index + '">');
        });

        $('input[name="cysfbx[]"]').bootstrapSwitch({
            onSwitchChange: function(event, state) {
                var row = $(this).closest('tr');
                row.find('td:lt(8):gt(1)').children('input').val('');

                if (true == state) {
                    row.find('td').slice(3, 7).children('input').attr('readonly', true);
                } else {
                    row.find('td:eq(2)').children('input').focus();
                    row.find('td:lt(7):gt(2)').children('input').attr('readonly', false);
                }
            }
        });
    });

    $('#xmcy-table').on('click', '.cy-remove', function() {
        $(this).closest('tr').remove();

        $('#xmcy-table tr').each(function(index) {
            $(this).children('td:eq(0)').children('input').val(index);
        });
    });

    $('#zdjs-table').on('click', '.js-add', function() {
        $(this).closest('tr').after('\
            <tr>\
                <td><input type="text" class="form-control" name="jspm[]" size="1" readonly></td>\
                <td><input type="checkbox" name="jssfbx[]" data-on-text="是" data-off-text="否" value="true" checked></td>\
                <td><input type="text" class="form-control" name="jsgh[]"></td>\
                <td><input type="text" class="form-control" name="jsxm[]" size="10" readonly></td>\
                <td><input type="text" class="form-control" name="zc[]" size="12" readonly></td>\
                <td><input type="text" class="form-control" name="szdw[]" readonly></td>\
                <td><input type="text" class="form-control" name="jslxdh[]" readonly></td>\
                <td><input type="text" class="form-control" name="email[]" readonly></td>\
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
            $(this).children('td:eq(0)').html('<input type="text" class="form-control" name="jspm[]" size="1" readonly value="' + index + '">');
        });

        $('input[name="jssfbx[]"]').bootstrapSwitch({
            onSwitchChange: function(event, state) {
                var row = $(this).closest('tr');
                row.find('td:lt(8):gt(1)').children('input').val('');

                if (true == state) {
                    row.find('td').slice(3, 8).children('input').attr('readonly', true);
                } else {
                    row.find('td:eq(2)').children('input').focus();
                    row.find('td:lt(8):gt(2)').children('input').attr('readonly', false);
                }
            }
        });
    });

    $('#zdjs-table').on('click', '.js-remove', function() {
        $(this).closest('tr').remove();

        $('#zdjs-table tr').each(function(index) {
            $(this).children('td:eq(0)').children('input').val(index);
        });
    });

    $('input[name="cysfbx[]"], input[name="jssfbx[]"]').bootstrapSwitch();

    $('#datepicker').datepicker({
        language: 'zh-CN',
        todayBtn: 'linked',
        todayHighlight: true,
        format: 'yyyy-mm-dd',
        startDate: '-0d',
        endDate: '+1y'
    });

    $('#xmcy-table').on('keyup blur', 'input[name="xh[]"]', function() {
        var xh = $(this);

        if (12 === $(this).val().length) {
            $.get({
                url: '{{ url('dcxm/xmcy') }}',
                data: {
                    xh: $(this).val()
                },
                success: function(data) {
                    var row = xh.closest('tr');
                    row.find('td:eq(3)').children('input').val(data.xm);
                    row.find('td:eq(4)').children('input').val(data.nj);
                    row.find('td:eq(5)').children('input').val(data.szyx);
                    row.find('td:eq(6)').children('input').val(data.lxdh);
                },
                dataType: 'json'
            });
        }
    });

    $('#zdjs-table').on('keyup blur', 'input[name="jsgh[]"]', function() {
        var jsgh = $(this);

        if (6 === $(this).val().length) {
            $.get({
                url: '{{ url('dcxm/zdjs') }}',
                data: {
                    jsgh: $(this).val()
                },
                success: function(data) {
                    var row = jsgh.closest('tr');
                    row.find('td:eq(3)').children('input').val(data.xm);
                    row.find('td:eq(4)').children('input').val(data.zc);
                    row.find('td:eq(5)').children('input').val(data.szdw);
                    row.find('td:eq(6)').children('input').val(data.lxdh);
                    row.find('td:eq(7)').children('input').val(data.email);
                },
                dataType: 'json'
            });
        }
    });
    $('#appForm').on('submit', function(e) {
        $('input[type="checkbox"]:not(:checked)').each(function() {
            $(this).prop('checked', true).val(false);
        })
    });
});
</script>
@endpush