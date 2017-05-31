<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Major;
use App\Models\Thesis;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

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
		$inputs   = $request->all();
		$keywords = explode(' ', $inputs['keywords']);

		$thesis = Thesis::with('instructor', 'college', 'major')
			->ofJs($inputs['js'])
			->ofXy($inputs['xy'])
			->ofZy($inputs['zy'])
			->ofLy($inputs['ly'])
			->ofKy($inputs['ky'])
			->ofYx($inputs['yx'])
			->ofXh($inputs['xh'])
			->ofXm($inputs['xm'])
			->ofZdjs($inputs['zdjsxm'])
			->whereZt(config('constants.status.enable'));

		foreach ($keywords as $keyword) {
			$thesis = $thesis->where('lwtm', 'like', '%' . $keyword . '%');
		}

		$datatable = Datatables::of($thesis)
			->addColumn('xymc', function ($paper) {
				return $paper->college->mc;
			})
			->addColumn('zymc', function ($paper) {
				return $paper->major->mc;
			})
			->addColumn('zdjsxm', function ($paper) {
				return $paper->instructor->xm;
			})
			->editColumn('ly', function ($paper) {
				switch ($paper->ly) {
				case 'J':
					return '教师出题';

				case 'Z':
					return '学生自拟';

				default:
					return '无';
				}
			})
			->editColumn('ky', function ($paper) {
				switch ($paper->ky) {
				case '1':
					return '是';

				case '0':
					return '否';

				default:
					return '否';
				}
			})
			->editColumn('yx', function ($paper) {
				switch ($paper->yx) {
				case '1':
					return '是';

				case '0':
					return '否';

				default:
					return '否';
				}
			});

		return $datatable->make(true);
	}
}
