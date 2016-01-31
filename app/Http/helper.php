<?php

namespace App\Http;

/**
 * 辅助函数类
 *
 * @author FuRongxin
 * @date 2016-01-30
 * @version 2.0
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
}