<?php

return [

	/**
	 * 数据状态代码
	 */
	'status' => [
		'enable'  => true,
		'disable' => false,
	],

	/**
	 * 日志操作类型
	 */
	'log'    => [
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
	'score'  => [
		'uncommitted' => '0', // 未提交
		'committed'   => '1', // 教师已提交
		'confirmed'   => '2', // 学院已提交
		'dconfirmed'  => '3', // 教务处已确认

		'passline'    => 60, // 及格线
	],

	/**
	 * 学籍状态
	 */
	'school' => [
		'student' => '01',
	],

	/**
	 * 上传文件参数
	 */
	'file'   => [
		'path'  => [
			'portrait' => 'uploads/portraits/',
		],
		'image' => [
			'width'   => 240,
			'height'  => 320,
			'ext'     => 'jpg',
			'quality' => 75,
			'mime'    => 'image/jpeg',
		],
	],
];