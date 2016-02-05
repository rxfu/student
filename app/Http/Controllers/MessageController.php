<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Auth;
use Yajra\Datatables\Datatables;

/**
 * 显示并处理学生短消息
 *
 * @author FuRongxin
 * @date 2016-01-15
 * @version 2.0
 */
class MessageController extends Controller {

	/**
	 * 显示短消息列表
	 * @author FuRongxin
	 * @date    2016-01-15
	 * @version 2.0
	 * @return  \Illuminate\Http\Response 短消息列表
	 */
	public function index() {

		return view('message.index')->withTitle('系统消息');
	}

	/**
	 * 列出短消息
	 * @author FuRongxin
	 * @date    2016-02-06
	 * @version 2.0
	 * @return  JSON 短消息
	 */
	public function listing() {
		$messages = Message::whereXh(Auth::user()->xh)
			->orderBy('fssj', 'desc');

		return Datatables::of($messages)->make(true);
	}
}
