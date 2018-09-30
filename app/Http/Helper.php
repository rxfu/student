<?php

namespace App\Http;

use Illuminate\Support\Str;

/**
 * 辅助函数类
 *
 * @author FuRongxin
 * @date 2016-09-01
 * @version 2.1.2
 */
class Helper {

	/**
	 * 去除字符串两端空白
	 * @author FuRongxin
	 * @date    2016-01-31
	 * @version 2.0
	 * @param   string $value 字符串
	 * @return  string 去除空白后的字符串
	 */
	public static function trimString($value) {
		return is_string($value) ? trim($value) : $value;
	}

	/**
	 * 获取CET4考试列表
	 * @author FuRongxin
	 * @date    2016-02-21
	 * @version 2.0
	 * @return  array CET4考试列表
	 */
	public static function getCet4() {
		return array_slice(config('constants.exam.type'), 3);
	}

	/**
	 * 12位课程序号转换为8位课程号
	 * @author FuRongxin
	 * @date    2016-03-09
	 * @version 2.0
	 * @param   string $kcxh 12位课程序号
	 * @return  string 8位课程号
	 */
	public static function getCno($kcxh) {
		return Str::substr($kcxh, 2, 8);
	}

	/**
	 * 判断12位课程序号的课程类型是否与输入的一致，如公体，社科……
	 * @author FuRongxin
	 * @date    2016-09-01
	 * @version 2.1.2
	 * @param   string $kcxh 12位课程序号
	 * @param   string $type 4位课程类型
	 * @return  boolean 一致返回true，不一致返回false
	 */
	public static function isCourseType($kcxh, $type) {
		return str_is($type . '*', $kcxh);
	}

	/**
	 * 将系统年度设置转换为学年度设置
	 * @author FuRongxin
	 * @date    2018-09-30
	 * @version 2.3
	 * @param   string $year 系统年度
	 * @return  string 学年度
	 */
	public static function getAcademicYear($year) {
		return $year . '~' . ($year + 1);
	}
}