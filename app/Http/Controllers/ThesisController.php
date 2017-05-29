<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * 显示并处理毕业论文信息
 *
 * @author FuRongxin
 * @date 2017-05-29
 * @version 2.2
 */
class ThesisController extends Controller {

	/**
	 * 显示毕业论文检索表单
	 * @author FuRongxin
	 * @date    2017-05-29
	 * @version 2.2
	 * @param   \Illuminate\Http\Request $request 检索请求
	 * @return  \Illuminate\Http\Response 毕业论文检索框
	 */
	public function showSearchForm(Request $request) {
		$title = '毕业论文检索';

		return view('thesis.search', compact('title'));
	}

	/**
	 * 检索毕业论文
	 *
	 * @author FuRongxin
	 * @date    2017-05-29
	 * @version 2.1.7
	 * @param   \Illuminate\Http\Request $request 检索请求
	 * @return  \Illuminate\Http\Response 检索结果
	 */
	public function search(Request $request) {
	}
}
