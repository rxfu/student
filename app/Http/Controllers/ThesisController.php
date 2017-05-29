<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Major;
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
		$inputs   = $request->all();
		$search   = isset($inputs['searched']) ? $inputs['searched'] : false;
		$js       = isset($inputs['js']) ? $inputs['js'] : '';
		$xy       = isset($inputs['xy']) ? $inputs['xy'] : 'all';
		$zy       = isset($inputs['zy']) ? $inputs['zy'] : 'all';
		$zdjsxm   = isset($inputs['zdjsxm']) ? $inputs['zdjsxm'] : '';
		$ly       = isset($inputs['ly']) ? $inputs['ly'] : 'all';
		$ky       = isset($inputs['ky']) ? $inputs['ky'] : 'all';
		$yx       = isset($inputs['yx']) ? $inputs['yx'] : 'all';
		$xh       = isset($inputs['xh']) ? $inputs['xh'] : '';
		$xm       = isset($inputs['xm']) ? $inputs['xm'] : '';
		$keywords = isset($inputs['keywords']) ? $inputs['keywords'] : '';

		$colleges = Department::colleges()
			->where('mc', '<>', '')
			->select('dw', 'mc')
			->orderBy('dw')
			->get();

		$majors = Major::whereZt(config('constants.status.enable'))
			->where('mc', '<>', '')
			->select('zy', 'mc', 'xy')
			->orderBy('zy')
			->get();

		$title = '毕业论文检索';

		return view('thesis.search', compact('title', 'search', 'js', 'xy', 'zy', 'zdjsxm', 'ly', 'ky', 'yx', 'xh', 'xm', 'keywords', 'colleges', 'majors'));
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
