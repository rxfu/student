@extends('app')

@section('content')
<section class="row">
    <div class="col-sm-8 col-sm-offset-2">
        <form id="searchForm" name="searchForm" method="get" action="{{ url('selcourse/search') }}" role="form">
            <input type="hidden" name="searched" value="true">
            <div class="input-group">
                <span class="input-group-btn">
                    <select name="type" class="selectpicker" data-style="btn-primary" data-width="100px">
                        <option value="kcxh"{{ 'kcxh' == $type ? ' selected' : '' }}>课程序号</option>
                        <option value="kcmc"{{ 'kcmc' == $type ? ' selected' : '' }}>课程名称</option>
                    </select>
                </span>
                <div class="form-group">
                    <label class="sr-only" for="keyword">课程检索</label>
                    <input type="search" class="form-control" id="keyword" name="keyword" placeholder="请输入关键词进行检索..." value="{{ $keyword }}">
                </div>
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit">Go!</button>
                </span>
            </div>
            <div class="voffset-top">
                <div class="col-sm-3">
                    <label for="nj">年度</label>
                    <select name="nj" id="nj" class="form-control">
                        <option value="all">==全部==</option>
                        @foreach ($grades as $grade)
                            <option value="{{ $grade->nj }}"{{ $grade->nj == $sgrade ? ' selected' : '' }}>{{ $grade->nj }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-4">
                    <label for="xy">开课学院</label>
                    <select name="xy" id="xy" class="form-control">
                        <option value="all">==全部==</option>
                        @foreach ($colleges as $college)
                            <option value="{{ $college->dw }}"{{ $college->dw == $scollege ? ' selected' : '' }}>{{ $college->mc }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-5">
                    <label for="zy">开课专业</label>
                    <select name="zy" id="zy" class="form-control">
                        <option value="all" class='all'>==全部==</option>
                        @foreach ($majors as $major)
                            <option value="{{ $major->zy }}" class="{{ $major->xy }}"{{ $major->zy == $smajor ? ' selected' : '' }}>{{ $major->mc }}</option>
                        @endforeach
                    </select>
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
                    <div role="tabpanel">
                        <ul id="campus-tab" class="nav nav-tabs" role="tablist">
                            @foreach ($campuses as $campus)
                                <li role="presentation"><a href="#campus-{{ $campus->dm }}" aria-controls="{{ $campus->dm }}" role="tab" data-toggle="tab" id="{{ $campus->dm }}">{{ $campus->mc }}</a></li>
                            @endforeach
                        </ul>
                        <div class="tab-content">
                            @foreach ($campuses as $campus)
                                <div id="campus-{{ $campus->dm }}" class="tab-pane fade{{ session('campus') == $campus->dm ? ' in active' : '' }}" role="tabpanel">
                                    <div class="table-responsive tab-table">
                                        <table id="selcourses-table-{{ $campus->dm }}" class="table table-bordered table-striped table-hover" width="100%">
                                            <thead>
                                                <tr>
                                                    <th class="active">重修申请</th>
                                                    <th class="active">其他申请</th>
                                                    <th class="active">课程序号</th>
                                                    <th class="active">课程名称</th>
                                                    <th class="active">学分</th>
                                                    <th class="active">周一</th>
                                                    <th class="active">周二</th>
                                                    <th class="active">周三</th>
                                                    <th class="active">周四</th>
                                                    <th class="active">周五</th>
                                                    <th class="active">周六</th>
                                                    <th class="active">周日</th>
                                                    <th class="active">考核方式</th>
                                                    <th class="active">上课人数</th>
                                                    <th class="active">已选人数</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>重修申请</th>
                                                    <th>其他申请</th>
                                                    <th>课程序号</th>
                                                    <th>课程名称</th>
                                                    <th>学分</th>
                                                    <th>周一</th>
                                                    <th>周二</th>
                                                    <th>周三</th>
                                                    <th>周四</th>
                                                    <th>周五</th>
                                                    <th>周六</th>
                                                    <th>周日</th>
                                                    <th>考核方式</th>
                                                    <th>上课人数</th>
                                                    <th>已选人数</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
@stop

@push('scripts')
    @if ($search)
        <script>
            $(function() {
                $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
                    $('#selcourses-table-' + $(e.target).attr('id')).dataTable({
                        'ajax': {
                            'url': '{!! url('selcourse/search') !!}/' + $(e.target).attr('id'),
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
                            { data: 'retake', name: 'retake'},
                            { data: 'other', name: 'other'},
                            { data: 'kcxh', name: 'kcxh' },
                            { data: 'kcmc', name: 'kcmc' },
                            { data: 'zxf', name: 'zxf' },
                            { data: 'Monday', name: 'Monday'},
                            { data: 'Tuesday', name: 'Tuesday'},
                            { data: 'Wednesday', name: 'Wednesday'},
                            { data: 'Thursday', name: 'Thursday'},
                            { data: 'Friday', name: 'Friday'},
                            { data: 'Saturday', name: 'Saturday'},
                            { data: 'Sunday', name: 'Sunday'},
                            { data: 'kh', name: 'kh' },
                            { data: 'zrs', name: 'zrs' },
                            { data: 'rs', name: 'rs' }
                        ],
                        'drawCallback': function (settings) {
                            @for ($i = 6; $i <= 12; $i++)
                                $('tr td:nth-child({{ $i }}):not(:empty)').addClass('warning');
                            @endfor
                        },
                        'destroy': true
                    });
                });

                $('#campus-tab a').click(function(e) {
                    e.preventDefault();
                    $(this).tab('show');
                });

                $('#campus-tab a[href="#campus-{{ session('campus') }}"]').tab('show');
            });
        </script>
    @endif
@endpush