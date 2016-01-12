<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Broadcast;

/**
 * 显示并处理系统消息
 *
 * @author FuRongxin
 * @date 2016-01-12
 * @version 2.0
 */
class HomeController extends Controller {

	/**
	 * 显示系统消息列表
	 * @author FuRongxin
	 * @date    2016-01-12
	 * @version 2.0
	 * @return  \Illuminate\Http\Response 系统消息列表
	 */
	public function index() {
		$broadcasts = Broadcast::where('id', '=', 'xt_web')->get();

		return view('home.index', ['title' => '综合管理系统', 'broadcasts' => $broadcasts]);
	}
}
