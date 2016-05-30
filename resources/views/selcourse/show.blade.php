@extends('app')

@section('content')
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
					                            <th class="active">操作</th>
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
					                            <th>操作</th>
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

<div class="modal fade" tabindex="-1" role="dialog" id="processing" data-backdrop="static" data-keyboard="false">
  	<div class="modal-dialog">
    	<div class="modal-content">
			<div class="modal-header">
	        	<h1 class="modal-title">保存中……</h1>
	    	</div>
	      	<div class="modal-body">
	        	<div class="progress">
	        		<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
	        			<span class="sr-only">保存中……</span>
	        		</div>
	        	</div>
	      	</div>
    	</div><!-- /.modal-content -->
  	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@stop

@push('scripts')
<script>
@if (session('forbidden'))
	alert('{{ session('forbidden') }}');
@endif

$(function() {
    $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
	    $('#selcourses-table-' + $(e.target).attr('id')).dataTable({
	        'ajax': '{!! url('selcourse/listing', [$type]) !!}/' + $(e.target).attr('id'),
	        'columns': [
	        	{ data: 'action', name: 'action'},
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
	        	@for ($i = 5; $i <= 11; $i++)
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

	$('table').on('submit', 'form', function(e) {
		var bSave = false;

		if ($(this).attr('name') == 'deleteForm') {
			bSave = confirm('你确定要退选“' + $(this).attr('data-id') + '-' + $(this).attr('data-name') + '”这门课程吗？') ? true : false;
		} else if ($(this).attr('name') == 'createForm') {
			bSave = confirm('你确定要选上“' + $(this).attr('data-id') + '-' + $(this).attr('data-name') + '”这门课程吗？') ? true : false;

			if (bSave){
				$('#processing').modal();

				$.ajax({
					'async': false,
					'url': '{!! url('selcourse/checktime') !!}/' + $(this).attr('data-id'),
					'success': function(data) {
						if (0 != data.length) {
							if (confirm('这门课程与已选课程' + data + '上课时间有冲突，确定选课吗？')) {
								bSave = true;
							} else {
								bSave = false;
							}
						}
					}
				});
			}
		}

		if (bSave) {
			$('#processing').modal();
		} else {
			$('#processing').modal('hide');
		}

		return bSave;
	});
});
</script>
@endpush