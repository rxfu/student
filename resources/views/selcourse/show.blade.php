@extends('app')

@section('content')
<section class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div role="tabpanel">
                    <ul id="campus-tab" class="nav nav-tabs" role="tablist">
                        @foreach ($campuses as $campus)
                            <li role="presentation"><a href="#campus-{{ $campus->dm }}" aria-controls="{{ $campus->dm }}" role="tab" data-toggle="tab">{{ $campus->mc }}</a></li>
                        @endforeach
                    </ul>
                    <div class="tab-content">
                        @foreach ($campuses as $campus)
                            <div id="campus-{{ $campus->dm }}" class="tab-pane fade{{ session('campus') == $campus->dm ? ' in active' : '' }}" role="tabpanel">
					            <div class="table-responsive tab-table">
					                <table id="selcourses-table-{{ $campus->dm }}" class="table table-bordered table-striped table-hover">
					                    <thead>
					                        <tr>
					                            <th class="active">操作</th>
					                            <th class="active">课程序号</th>
					                            <th class="active">课程名称</th>
					                            <th class="active">学分</th>
					                            <th class="active">校区</th>
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
					                            <th>操作</th>
					                            <th>课程序号</th>
					                            <th>课程名称</th>
					                            <th>学分</th>
					                            <th>校区</th>
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
@stop

@push('scripts')
<script>
$(function() {
	@foreach ($campuses as $campus)
    $('#selcourses-table-{{ $campus->dm }}').dataTable({
        'ajax': '{!! url('selcourse/listing', [$type, $campus->dm]) !!}',
        'columns': [
        	{ data: 'action', name: 'action'},
            { data: 'kcxh', name: 'kcxh' },
            { data: 'kcmc', name: 'kcmc' },
            { data: 'zxf', name: 'zxf' },
            { data: 'xqmc', name: 'xqmc' },
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
        'initComplete': function (settings, json) {
        	@for ($i = 6; $i <= 12; $i++)
    			$('tr td:nth-child({{ $i }}):not(:empty)').addClass('warning');
        	@endfor
        }
    });
    @endforeach

	$('#campus-tab a').click(function(e) {
		e.preventDefault();
		$(this).tab('show');
	});

	$('#campus-tab a[href="#campus-' + {{ session('campus') }} + '"]').tab('show');
});
</script>
@endpush