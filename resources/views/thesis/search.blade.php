@extends('app')

@section('content')
<section class="row">
    <div class="col-sm-8 col-sm-offset-2">
        <form id="searchForm" name="searchForm" method="get" action="{{ url('thsis/search') }}" role="form" class="form-horizonal">
            <input type="hidden" name="searched" value="true">
            <div class="form-group">
                <label for="js" class="col-sm-2 control-label">届数</label>
                <div class="col-sm-10">
                    <input type="search" class="form-control" id="js" name="js" placeholder="届数" value="{{ $js }}">
                </div>
            </div>
            <div class="form-group">
                <label for="xy" class="col-sm-2 control-label">学院（部）</label>
                <div class="col-sm-10">
                    <select name="xy" id="xy" class="form-control">
                        <option value="all">==全部==</option>
                        @foreach ($colleges as $college)
                            <option value="{{ $college->dw }}"{{ $college->dw == $scollege ? ' selected' : '' }}>{{ $college->mc }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="zy" class="col-sm-2 control-label">专业</label>
                <div class="col-sm-10">
                    <select name="zy" id="zy" class="form-control">
                        <option value="all" class="all {{ $colleges->implode('dw', ' ') }}">==全部==</option>
                        @foreach ($majors as $major)
                            <option value="{{ $major->zy }}" class="{{ $major->xy }}"{{ $major->zy == $smajor ? ' selected' : '' }}>{{ $major->mc }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="zdjsxm" class="col-sm-2 control-label">指导教师姓名</label>
                <div class="col-sm-10">
                    <input type="search" class="form-control" id="zdjsxm" name="zdjsxm" placeholder="指导教师姓名" value="{{ $zdjsxm }}">
                </div>
            </div>
            <div class="form-group">
                <label for="ly" class="col-sm-2 control-label">课题来源</label>
                <div class="col-sm-10">
                    <select name="ly" id="ly" class="form-control">
                        <option value="all">==全部==</option>
                        <option value="J">教师出题</option>}
                        <option value="Z">学生自拟</option>}
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="ky" class="col-sm-2 control-label">是否科研项目</label>
                <div class="col-sm-10">
                    <select name="ky" id="ky" class="form-control">
                        <option value="all">==全部==</option>
                        <option value="1">是</option>}
                        <option value="0">否</option>}
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="yx" class="col-sm-2 control-label">是否优秀毕业论文（设计）</label>
                <div class="col-sm-10">
                    <select name="yx" id="yx" class="form-control">
                        <option value="all">==全部==</option>
                        <option value="1">是</option>}
                        <option value="0">否</option>}
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="xh" class="col-sm-2 control-label">学号</label>
                <div class="col-sm-10">
                    <input type="search" class="form-control" id="xh" name="xh" placeholder="学号" value="{{ $xh }}">
                </div>
            </div>
            <div class="form-group">
                <label for="xm" class="col-sm-2 control-label">姓名</label>
                <div class="col-sm-10">
                    <input type="search" class="form-control" id="xm" name="xm" placeholder="姓名" value="{{ $xm }}">
                </div>
            </div>
            <div class="form-group">
                <label for="keywords" class="col-sm-2 control-label">毕业论文（设计）题目关键词</label>
                <div class="col-sm-10">
                    <input type="search" class="form-control" id="keywords" name="keywords" placeholder="毕业论文（设计）题目关键词" value="{{ $keywords }}">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button class="btn btn-primary" type="submit">查询</button>
                </div>
            </div>
        </form>
    </div>
</section>

@if ($search)
    <section class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table id="thesis-table" class="table table-bordered table-striped table-hover" width="100%">
                            <thead>
                                <tr>
                                    <th class="active">届数</th>
                                    <th class="active">题目</th>
                                    <th class="active">学号</th>
                                    <th class="active">姓名</th>
                                    <th class="active">指导教师</th>
                                    <th class="active">学院</th>
                                    <th class="active">专业</th>
                                    <th class="active">课题来源</th>
                                    <th class="active">是否科研项目</th>
                                    <th class="active">是否优秀论文</th>
                                    <th class="active">成绩</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>届数</th>
                                    <th>题目</th>
                                    <th>学号</th>
                                    <th>姓名</th>
                                    <th>指导教师</th>
                                    <th>学院</th>
                                    <th>专业</th>
                                    <th>课题来源</th>
                                    <th>是否科研项目</th>
                                    <th>是否优秀论文</th>
                                    <th>成绩</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
@stop

@push('scripts')
    <script>
        $(function() {
            $('#zy').chained('#xy');

            @if ($search)
                $('thesis-table').dataTable({
                    'ajax': {
                        'url': '{!! url('thesis/search') !!}/' + $(e.target).attr('id'),
                        'data': {
                            'searched': '{{ $search }}',
                            'nj': '{{ $sgrade }}',
                            'xy': '{{ $scollege }}',
                            'zy': '{{ $smajor }}',
                            'keyword': '{{ $keyword }}',
                            'type': '{{ $type }}'
                        }
                    },
                    'columns': [
                        { data: 'js', name: 'js'},
                        { data: 'lwtm', name: 'lwtm'},
                        { data: 'xh', name: 'xh' },
                        { data: 'xm', name: 'xm' },
                        { data: 'zdjsxm', name: 'zdjsxm' },
                        { data: 'xymc', name: 'xymc' },
                        { data: 'zymc', name: 'zymc' },
                        { data: 'ly', name: 'ly' },
                        { data: 'ky', name: 'ky'},
                        { data: 'yx', name: 'yx'},
                        { data: 'cj', name: 'cj'}
                    ],
                    'destroy': true
                });
            @endif
        });
    </script>
@endpush