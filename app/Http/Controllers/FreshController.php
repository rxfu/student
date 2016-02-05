<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * 显示并处理新生信息
 *
 * @author FuRongxin
 * @date 2016-02-06
 * @version 2.0
 */
class FreshController extends Controller {

	/**
	 * 显示新生信息填报表
	 *
	 * @param  string  $xh
	 * @return \Illuminate\Http\Response
	 */
	public function edit($xh) {
		$profile = Fresh::find($xh);

		return view('fresh.edit')
			->withTitle('新生信息核对')
			->withStatus('初次登录请务必修改密码，若密码忘记请联系年级辅导员初始化。')
			->withProfile($profile);
	}

	/**
	 * 更新新生籍贯、家长姓名、家庭地址、联系电话等信息
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  string  $xh
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $xh) {
		//
	}

}
