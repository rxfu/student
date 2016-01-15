<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Slog;
use Auth;

/**
 * 显示并处理学生选课日志
 *
 * @author FuRongxin
 * @date 2016-01-15
 * @version 2.0
 */
class LogController extends Controller {

	/**
	 * 显示选课日志列表
	 * @author FuRongxin
	 * @date    2016-01-15
	 * @version 2.0
	 * @return  \Illuminate\Http\Response 选课日志列表
	 */
	public function index() {
		$logs = Slog::whereXh(Auth::user()->xh)
			->orderBy('czsj', 'desc')
			->get();

		return view('log.index')->withTitle('选课日志')->withLogs($logs);
	}
}
