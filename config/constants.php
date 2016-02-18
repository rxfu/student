<?php

return [

	/**
	 * 数据状态代码
	 */
	'status'    => [
		'enable'  => true,
		'disable' => false,
	],

	/**
	 * 日志操作类型
	 */
	'log'       => [
		'login'  => '登录系统',
		'logout' => '登出系统',
		'chgpwd' => '修改密码',
		'insert' => '选课',
		'delete' => '退课',
		'regist' => '考试报名',
		'cancel' => '取消报名',
		'apply'  => '选课申请',
		'revoke' => '撤销申请',
	],

	/**
	 * 成绩状态代码
	 */
	'score'     => [
		'uncommitted' => '0', // 未提交
		'committed'   => '1', // 教师已提交
		'confirmed'   => '2', // 学院已提交
		'dconfirmed'  => '3', // 教务处已确认

		'passline'    => 60, // 及格线
	],

	/**
	 * 学籍状态
	 */
	'school'    => [
		'student' => '01', // 在读学生
	],

	/**
	 * 上传文件参数
	 */
	'file'      => [

		// 路径
		'path'   => [
			'portrait' => 'portraits/', // 考试照片路径
			'photo'    => 'photos/', // 学你照片路径
		],

		// 图片参数
		'image'  => [
			'width'   => 240, // 图片宽度
			'height'  => 320, // 图片高度
			'ext'     => 'jpg', // 图片类型
			'quality' => 75, // 图片质量
		],

		// 照片状态
		'status' => [
			'none'     => '0', // 无照片
			'uploaded' => '1', // 照片已上传
			'passed'   => '2', // 照片已确认
			'refused'  => '3', // 照片审核未通过
		],
	],

	/**
	 * 课程表时间段参数
	 */
	'timetable' => [
		'morning'   => [
			'id'    => 'morning',
			'begin' => 1,
			'end'   => 5,
			'name'  => '上午',
			'rest'  => '午休',
		],
		'afternoon' => [
			'id'    => 'afternoon',
			'begin' => 6,
			'end'   => 9,
			'name'  => '下午',
			'rest'  => '晚饭',
		],
		'evening'   => [
			'id'    => 'evening',
			'begin' => 10,
			'end'   => 12,
			'name'  => '晚上',
			'rest'  => '熄灯',
		],
	],
];