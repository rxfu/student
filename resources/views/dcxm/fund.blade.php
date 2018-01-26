@extends('app')

@section('content')
<form id="appForm" name="appForm" method="post" action="{{ url('dcxm/xmjf/' . $project->id) }}" class="form-horizontal">
    {!! csrf_field() !!}
    <section class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">项目经费使用计划</div>
                </div>
                <div class="panel-body">
                    <table id="xmjf-table" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="active">开支科目</th>
                                <th class="active">预算经费（元）</th>
                                <th class="active">主要用途</th>
                                <th class="active">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total = 0;?>
                            @forelse ($funds as $key => $fund)
                                <?php $total += $fund->je;?>
                                <tr>
                                    <input type="hidden" name="jfid[]" value="{{ $fund->id }}">
                                    <td>
                                        <input type="text" class="form-control" name="kzkm[]" value="{{ $fund->kzkm }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="je[]" value="{{ $fund->je }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="yt[]" value="{{ $fund->yt }}">
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <button type="button" title="增加" class="btn btn-success add"><i class="fa fa-plus"></i></button>
                                                @if (0 != $key)
                                                    <button type="button" title="减少" class="btn btn-danger remove"><i class="fa fa-minus"></i></button>
                                                @endif
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <input type="hidden" name="jfid[]" value="id">
                                    <td>
                                        <input type="text" class="form-control" name="kzkm[]">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="je[]">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="yt[]">
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <button type="button" title="增加" class="btn btn-success add"><i class="fa fa-plus"></i></button>
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                            <tr>
                                <th>合计</th>
                                <th>
                                    <span id="total">{{ $total }}</span>
                                </th>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4">
                                    <ol>
                                        创新训练、创业训练项目的经费使用范围如下：
                                        <li>调研、差旅费；</li>
                                        <li>用于项目研发的元器件、软硬件测试、小型硬件购置费等；</li>
                                        <li>资料购置、打印、复印、印刷等费用；</li>
                                        <li>学生撰写与项目有关的论文版面费、申请专利费等。</li>
                                    </ol>
                                </td>
                            </tr>
                        </tfoot>
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
    $('#xmjf-table').on('click', '.add', function() {
        $(this).closest('tr').after('\
            <tr>\
                <input type="hidden" name="jfid[]" value="id">\
                <td><input type="text" class="form-control" name="kzkm[]"></td>\
                <td><input type="text" class="form-control" name="je[]"></td>\
                <td><input type="text" class="form-control" name="yt[]"></td>\
                <td>\
                    <div class="input-group">\
                        <span class="input-group-btn">\
                            <button type="button" title="增加" class="btn btn-success add"><i class="fa fa-plus"></i></button>\
                            <button type="button" title="减少" class="btn btn-danger remove"><i class="fa fa-minus"></i></button>\
                        </span>\
                    </div>\
                </td>\
            </tr>\
        ');
    });

    $('#xmjf-table').on('click', '.remove', function() {
        $(this).closest('tr').remove();
    });

    $('#xmjf-table').on('keyup blur', 'input[name="je[]"]', function() {
        $('#total').html(function() {
            var total = 0;
            $('input[name="je[]"]').each(function() {
                total += Number($(this).val());
            });

            return total;
        });
    });
});
</script>
@endpush