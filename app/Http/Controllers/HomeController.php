<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Helper;
use App\Models\Broadcast;
use App\Models\Bymd;
use App\Models\Byxwpd;
use App\Models\Cfxx;
use App\Models\Setting;
use App\Models\Term;
use Auth;

/**
 * 显示并处理系统消息
 *
 * @author FuRongxin
 * @date 2016-01-12
 * @version 2.0
 */
class HomeController extends Controller
{

	/**
	 * 显示系统消息列表
	 * @author FuRongxin
	 * @date    2016-01-12
	 * @version 2.0
	 * @return  \Illuminate\Http\Response 系统消息列表
	 */
	public function index()
	{
		$is_open    = (config('constants.status.enable') == Setting::find('XK_KG')->value) ? '开放' : '关闭';
		$message    = '现在' . $is_open . Helper::getAcademicYear(session('year')) . '年度' . Term::find(session('term'))->mc . '学期选课';
		$broadcasts = Broadcast::whereId('xk_web')->whereGldw(Auth::user()->profile->gldw)->get();
		$cfxxs      = Cfxx::with('profile', 'jg')->whereXh(Auth::user()->xh)->get();
		$bymds      = Bymd::with('byflzd')->whereXh(Auth::user()->xh)->orderBy('pc', 'desc')->get();
		$byxwpds    = Byxwpd::whereXh(Auth::user()->xh)->orderBy('pc', 'desc')->get();
		$title      = '综合管理系统';

		return view('home.index', compact('title', 'broadcasts', 'message', 'cfxxs', 'bymds', 'byxwpds'));
	}

	public function error(Request $request)
	{
		$message = $request->input('message');

		return view('errors.message', compact('message'));
	}
}
