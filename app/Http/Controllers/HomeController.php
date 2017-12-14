<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Broadcast;
use App\Models\Cfxx;
use App\Models\Setting;
use App\Models\Term;
use Auth;
use DB;

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
		$is_open    = (config('constants.status.enable') == Setting::find('XK_KG')->value) ? '开放' : '关闭';
		$message    = '现在' . $is_open . session('year') . '年度' . Term::find(session('term'))->mc . '学期选课';
		$broadcasts = Broadcast::whereId('xt_web')->get();
		$cfxxs      = Cfxx::with('profile', 'jg')->whereXh(Auth::user()->xh)->get();
		$title      = '综合管理系统';
		$cwc        = DB::connection('cwcsrv')->select('select * from VW_Mid_ChargeMid where StudentCode = ?', ['201610600008']);
		dd($cwc);
		return view('home.index', compact('title', 'broadcasts', 'message', 'cfxxs'));
	}
}
