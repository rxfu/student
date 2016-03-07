$.extend(true, $.fn.dataTable.defaults, {
	'pagingType': 'full_numbers',
	'lengthMenu': [
		[10, 25, 50, -1],
		[10, 25, 50, '全部']
	],
	'ordering': false,
	'processing': true,
	'serverSide': true,
	'language': {
		'url': '/student/js/plugins/dataTables/i18n/zh_cn.lang'
	},
	'deferRender': true,
	'autoWidth': true
});

(function($) {
	$.fn.getBaseUrl = function() {
		var pathname = $(location).attr('pathname').substring(1);
		var webroot = '' === pathname ? '' : pathname.substring(0, pathname.indexOf('/'));
		return $(location).attr('protocol') + '//' + $(location).attr('host') + '/' + webroot + '/';
	};
})(jQuery);
$(document).ready(function() {
	/** New student */
	/*$('#course-table').dataTable({
		'pagingType': 'full_numbers',
		'paging': false,
		'ordering': false,
		'language': {
			'url': './js/plugins/dataTables/i18n/zh_cn.lang'
		},
		'serverSide': true,
		'processing': true,
		'scrollY': 200,
		'scroller': {
			'loadingIndicator': true
		},
		'ajax': 'course/listing'
	});*/
	/** End New student */
	$('#loading').hide();
	$('article').show();

	$('a[href="' + $(location).attr('href') + '"]').parents('ul.nav').not('ul#side-menu').addClass('collapse in');
	$('#accordion .panel-collapse:first').collapse('show');

	$('#loginForm')
		.formValidation({
			framework: 'bootstrap',
			icon: {
				valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
			},
			fields: {
				username: {
					message: '用户名无效',
					validators: {
						notEmpty: {
							message: '用户名不能为空'
						},
						regexp: {
							regexp: /^[0-9]+$/,
							message: '用户名只能是数字格式'
						}
					}
				},
				password: {
					validators: {
						notEmpty: {
							message: '密码不能为空'
						}
					}
				}
			}
		});
	$('#passwordForm')
		.formValidation({
			framework: 'bootstrap',
			icon: {
				valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
			},
			fields: {
				oldPassword: {
					validators: {
						notEmpty: {
							message: '旧密码不能为空'
						}
					},
					different: {
						field: 'newPassword',
						message: '新密码与旧密码相同'
					}
				},
				newPassword: {
					validators: {
						notEmpty: {
							message: '新密码不能为空'
						},
						different: {
							field: 'oldPassword',
							message: '新密码与旧密码相同'
						},
						identical: {
							field: 'confirmedPassword',
							message: '两次输入密码不一致'
						}
					}
				},
				confirmedPassword: {
					validators: {
						notEmpty: {
							message: '确认密码不能为空'
						},
						identical: {
							field: 'newPassword',
							message: '两次输入密码不一致'
						}
					}
				}
			}
		});
	$('form[name="scoreForm"]')
		.formValidation({
			framework: 'bootstrap',
			icon: {
				valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
			},
			fields: {
				score: {
					validators: {
						notEmpty: {
							message: '成绩不能为空'
						},
						integer: {
							message: '成绩必须是正整数'
						},
						between: {
							min: 0,
							max: 100,
							message: '成绩必须是0~100间的正整数'
						}
					}
				}
			}
		})
		.off('success.form.fv')
		.on('success.form.fv', function(e) {
			// Prevent form submission
			e.preventDefault();

			var form = $(e.target);
			var fv = form.data('formValidation');

			// Use Ajax to submit form data
			$.ajax({
				type: "post",
				dataType: "json",
				url: form.prop("action"),
				data: form.serialize(),
				success: function(response) {
					total = form.closest('tr').find('.total');

					if (true === response.success) {
						total.addClass('text-success').text(response.data);
					} else {
						total.addClass('text-danger').text('保存失败');
					}
				},
				error: function() {
					form.closest('tr').find('.total').addClass('text-danger').text('提交失败');
				}
			});

			// Then submit the form as usual
			// fv.defaultSubmit();
		});
	$(':input[name="score"]').on('keypress', function(e) {
		// Enter pressed
		if (e.keyCode == 13) {
			var inputs = $(this).parents('table').find(':input[name="score"]');
			var idx = inputs.index(this);

			if (idx == inputs.length - 1) {
				inputs[0].select();
			} else {
				inputs[idx + 1].focus();
				inputs[idx + 1].select();
			}

			$(this).closest('form').submit();
			return false;
		}
	}).on('change', function(e) {
		$(this).closest('form').submit();
		return false;
	});
	$('select[name^="status"]').change(function() {
		var select = $(this);
		var form = $(this).closest('form');
		var sno = $(this).closest('tr').attr('data-row');

		$.ajax({
			type: "post",
			url: form.prop("action"),
			data: {
				"sno": sno,
				"status": $(this).val()
			},
			success: function(response) {
				select.wrap('<div class="has-success has-feedback"></div>').after('<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>');
			},
			error: function(xhr, status) {
				select.wrap('<div class="has-error has-feedback"></div>').after('<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>');
			}
		});
	});
	$('.data-table').dataTable({
		'lengthMenu': [
			[10, 25, 50, -1],
			[10, 25, 50, '全部']
		],
		'pagingType': 'full_numbers',
		'ordering': false,
		'language': {
			'url': $().getBaseUrl() + 'js/plugins/dataTables/i18n/zh_cn.lang'
		}
	});
	$('.course-table').dataTable({
		'paging': false,
		'ordering': false,
		'language': {
			'url': $().getBaseUrl() + 'js/plugins/dataTables/i18n/zh_cn.lang'
		}
	});
	$('#courseConfirm').on('show.bs.modal', function(e) {
		var form = $(e.relatedTarget).closest('form');
		$(this).find('.modal-footer #confirm').data('form', form);

		if (true === form.find('input:checkbox').is(':checked')) {
			$(this).find('.modal-title').text('选课确认');
			$(this).find('.modal-body p').html('即将选择<span id="course" class="text-danger">' + $(e.relatedTarget).attr('data-whatever') + '</span>课程，确认选课？');
		} else {
			$(this).find('.modal-title').text('退课确认');
			$(this).find('.modal-body p').html('即将退选<span id="course" class="text-danger">' + $(e.relatedTarget).attr('data-whatever') + '</span>课程，确认退课？');
		}
	});
	$('#courseConfirm').find('.modal-footer #confirm').on('click', function() {
		var form = $(this).data('form');
		var checkbox = form.find('input:checkbox');
		var checked = (true === checkbox.is(':checked')) ? 'true' : 'false';

		if ('true' == checked) {
			var cno = form.find('input[name="course"]').val();
			var type = form.find('input[name="type"]').val();
			var result;

			// 人数是否已满
			$.ajax({
				async: false,
				url: $().getBaseUrl() + 'course/full/' + cno + '/' + type,
				success: function(data) {
					result = $.parseJSON(data);
				}
			});
			if (true === result.status) {
				$('#fullConfirm').on('show.bs.modal', function(e) {
					$(this).find('.modal-title').text('人数超限');
					$(this).find('.modal-body p').html('选课人数已达上限！');
				});
				$('#fullConfirm').on('hidden.bs.modal', function(e) {
					$('#courseConfirm').modal('hide');
				});
				$('#fullConfirm').modal('show');
				return false;
			}

			// 选课时间是否冲突
			$.ajax({
				async: false,
				url: $().getBaseUrl() + 'course/clash/' + cno,
				success: function(data) {
					result = $.parseJSON(data);
				}
			});
			if ('object' == typeof result.status) {
				$('#clashConfirm').on('show.bs.modal', function(e) {
					$(this).find('.modal-title').text('时间冲突');
					$(this).find('.modal-body p').html('选课时间冲突！是否继续选课？');
				});
				$('#clashConfirm').find('.modal-footer #confirm').on('click', function() {
					checkbox.siblings('input:hidden[name="checked"]').val(checked);
					form.submit();
				});
				$('#clashConfirm').find('.modal-footer #cancel').on('click', function() {
					$('#courseConfirm').modal('hide');
				});
				$('#clashConfirm').modal('show');
				return false;
			}
		}
		checkbox.siblings('input:hidden[name="checked"]').val(checked);
		form.submit();
	});
	$('#courseConfirm').on('hidden.bs.modal', function(e) {
		location.reload();
	});
	$('#lcno').change(function() {
		selected = $('#lcno option:selected');
		$('#lyear').val(selected.attr('data-year'));
		$('#lyear-name').val(selected.attr('data-year-name'));
		$('#lterm').val(selected.attr('data-term'));
		$('#lterm-name').val(selected.attr('data-term-name'));
	});

	$('#confirmDialog').on('show.bs.modal', function(e) {
		var button = $(e.relatedTarget);
		var title = button.data('title');
		var message = button.data('message');

		var modal = $(this);
		modal.find('.modal-title').text(title);
		modal.find('.modal-body p').text(message);

		var form = button.closest('form');
		modal.find('.modal-footer #confirm').data('form', form);
	});
	$('#confirmDialog').find('.modal-footer #confirm').on('click', function(e) {
		$(this).data('form').submit();
	});

	$('.modal').modal({
		show: false,
		backdrop: 'static',
	});
	$('#tipsModal').modal('show');
});