<?php

use Carbon\Carbon;

/**
 * 常用系统参数
 *
 * @author FuRongxin
 * @date 2016-01-15
 * @version 2.0
 */
return [

	/**
	 * 数据状态代码
	 */
	'status'      => [
		'enable'  => true,
		'disable' => false,
	],

	/**
	 * 日志操作类型
	 */
	'log'         => [
		'login'  => '登录系统',
		'logout' => '登出系统',
		'chgpwd' => '修改密码',
		'insert' => '选课',
		'delete' => '退课',
		'regist' => '考试报名',
		'cancel' => '取消报名',
		'apply'  => '选课申请',
		'revoke' => '撤销申请',
		'trsfrm' => '课程转换',
	],

	/**
	 * 单位类型代码
	 */
	'department'  => [
		'college'   => '1', // 教学
		'manager'   => '2', // 管理
		'assistant' => '3', //教辅
		'other'     => '4', // 其他
	],

	/**
	 * 成绩状态代码
	 */
	'score'       => [
		'uncommitted' => '0', // 未提交
		'committed'   => '1', // 教师已提交
		'confirmed'   => '2', // 学院已提交
		'dconfirmed'  => '3', // 教务处已确认

		'passline'    => 60, // 及格线
	],

	/**
	 * 学籍状态
	 */
	'school'      => [
		'student' => '01', // 在读学生
	],

	/**
	 * 上传文件参数
	 */
	'file'        => [

		// 路径
		'path'   => [
			'portrait' => 'portraits/', // 考试照片路径
			'photo'    => 'photos/', // 学你照片路径
			'dcxm'     => 'dcxm/', // 大创项目证明材料路径
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
	'timetable'   => [

		// 上午
		'morning'   => [
			'id'    => 'morning',
			'begin' => 1,
			'end'   => 5,
			'name'  => '上午',
			'rest'  => '午休',
		],

		// 下午
		'afternoon' => [
			'id'    => 'afternoon',
			'begin' => 6,
			'end'   => 9,
			'name'  => '下午',
			'rest'  => '晚饭',
		],

		// 晚上
		'evening'   => [
			'id'    => 'evening',
			'begin' => 10,
			'end'   => 12,
			'name'  => '晚上',
			'rest'  => '熄灯',
		],
	],

	/**
	 * 考试代码
	 */
	'exam'        => [

		// 考试类型代码
		'type'   => [
			'cet'  => '1', // 大学英语考试
			'cet3' => '03', // 英语三级
			'cet6' => '06', // 英语六级
			'cet4' => '04', // 英语四级
			'cjt4' => '22', // 日语四级
			'cft4' => '23', // 法语四级
		],

		// 考试报名状态代码
		'status' => [
			'register'  => '1', // 已报名
			'confirmed' => '2', // 报名已确认
			'payment'   => '3', // 报名已缴费
		],
	],

	/**
	 * 选课申请代码
	 */
	'application' => [

		// 选课类型
		'type'  => [
			'0' => '其他课程',
			'1' => '重修',
		],

		// 审核标志
		'audit' => [
			'0' => '未审核',
			'1' => '审核已通过',
			'2' => '审核未通过',
		],

		// 缴费标志
		'paid'  => [
			'0' => '未缴费',
			'1' => '已缴费',
		],
	],

	/**
	 * 课程代码
	 */
	'course'      => [
		'public'   => [
			'type' => 'TB',
			'name' => '公共课程',
		],
		'require'  => [
			'type' => 'B',
			'name' => '必修课程',
		],
		'elect'    => [
			'type' => 'X',
			'name' => '选修课程',
		],
		'general'  => [
			'human'  => [
				'type' => 'TW',
				'name' => '人文社科通识素质课程',
			],
			'nature' => [
				'type' => 'TI',
				'name' => '自然科学通识素质课程',
			],
			'art'    => [
				'type' => 'TY',
				'name' => '艺术体育通识素质课程',
			],
			/*'other'  => [
				'type' => 'TQ',
				'name' => '其他专项通识素质课程',
			],*/
		],
		'others'   => [
			'type' => 'OTHERS',
			'name' => '其他课程',
		],
		'retake'   => [
			'type' => 'RETAKE',
			'name' => '重修课程',
		],

		/**
		 * 应教务处要求单独增加公体选课
		 * @author FuRongxin
		 * @date 2016-05-15
		 * @version 2.1
		 */
		'pubsport' => [
			'type' => 'TB14',
			'name' => '公共体育课程',
		],

		/**
		 * 应教务处要求增加大学外语课单独管理
		 * @author FuRongxin
		 * @date 2021-03-04
		 * @version 2.3
		 */
		'foreign' => [
			'type' => 'TB13',
			'name' => '大学外语课程',
		],
	],

	/**
	 * 大创项目代码
	 */
	'dcxm'        => [
		'begdate' => Carbon::create(null, 5, 1),
	],

	/**
	 * 星期名称对应
	 */
	'week'       => [
		'1' => '一',
		'2' => '二',
		'3' => '三',
		'4' => '四',
		'5' => '五',
		'6' => '六',
		'7' => '日',
	],
];