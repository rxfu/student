<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Auth;

/**
 * 显示并处理个人资料
 *
 * @author FuRongxin
 * @date 2016-01-12
 * @version 2.0
 */
class ProfileController extends Controller {

	/**
	 * 显示个人资料列表
	 * @author FuRongxin
	 * @date    2016-01-12
	 * @version 2.0
	 * @return  \Illuminate\Http\Response 个人资料列表
	 */
	public function index() {
		$profile = Profile::find(Auth::user()->xh);

		return view('profile.index')->withTitle('个人资料')->withProfile($profile);
	}

}
