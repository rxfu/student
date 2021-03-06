<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Helper;
use App\Models\Course;
use App\Models\Dtscore;
use App\Models\Exscore;
use App\Models\Muscore;
use App\Models\Ratio;
use App\Models\Score;
use Auth;
use Yajra\Datatables\Datatables;

/**
 * 显示并处理学生成绩单
 *
 * @author FuRongxin
 * @date 2016-01-25
 * @version 2.0
 */
class ScoreController extends Controller {

	/**
	 * 显示学生综合成绩单
	 * @author FuRongxin
	 * @date    2016-01-25
	 * @version 2.0
	 * @return  \Illuminate\Http\Response 学生成绩单
	 */
	public function index() {
		return view('score.index')->withTitle('综合成绩单');
	}

	/**
	 * 列出学生综合成绩单
	 * @author FuRongxin
	 * @date    2016-02-05
	 * @version 2.0
	 * @return  JSON 学生成绩单
	 */
	public function listing() {
		$scores = Score::with(['term' => function ($query) {
			$query->select('dm', 'mc');
		}])
			->with(['platform' => function ($query) {
				$query->select('dm', 'mc');
			}])
			->with(['property' => function ($query) {
				$query->select('dm', 'mc');
			}])
			->with(['mode' => function ($query) {
				$query->select('dm', 'mc');
			}])
			->with(['exstatus' => function ($query) {
				$query->select('dm', 'mc');
			}])
			->with(['course' => function ($query) {
				$query->select('kch', 'kcmc');
			}])
			->whereXh(Auth::user()->xh)
			->orderBy('nd', 'desc')
			->orderBy('xq', 'desc')
			->orderBy('kch', 'asc');

		return Datatables::of($scores)
			->editColumn('nd', function ($score) {
				return Helper::getAcademicYear($score->nd);
			})
			->editColumn('kcmc', function ($score) {
				return '<a href="' . url('score', $score->kch) . '">' . $score->course->kcmc . '</a>';
			})
			->setRowClass(function ($score) {
				return $score->cj < config('constants.score.passline') ? 'danger' : '';
			})
			->escapeColumns(['*'])
			->make(true);
	}

	/**
	 * 显示学生详细成绩单
	 * @author FuRongxin
	 * @date    2016-01-25
	 * @version 2.0
	 * @param   string $kch 8位课程号
	 * @return  \Illuminate\Http\Response 学生成绩单
	 */
	public function show($kch) {

		// 过程成绩
		$detail = Dtscore::detailScore(Auth::user(), $kch)
			->select('xh', 'xm', 'kcxh', 'kcpt', 'kcxz', 'nd', 'xq', 'kh', 'cj1', 'cj2', 'cj3', 'cj4', 'cj5', 'cj6', 'zpcj', 'kszt', 'tjzt');

		// 补考成绩
		$makeup = Muscore::makeupScore(Auth::user(), $kch)
			->select('xh', 'xm', 'kcxh', 'kcpt', 'kcxz', 'nd', 'xq', 'kh', 'cj1', 'cj2', 'cj3', 'cj4', 'cj5', 'cj6', 'zpcj', 'kszt', 'tjzt');

		$scores = $detail->union($makeup)
			->orderBy('nd', 'desc')
			->orderBy('xq', 'desc')
			->get();

		$ratios = $this->_arrangeScores($scores);

		return view('score.show')->withTitle(Course::find($kch)->kcmc . '课程详细成绩单')->withRatios($ratios);
	}

	/**
	 * 显示学生待确认成绩单
	 * @author FuRongxin
	 * @date    2016-01-27
	 * @version 2.0
	 * @return  \Illuminate\Http\Response 学生成绩单
	 */
	public function unconfirmed() {

		// 显示提交状态小于3的成绩
		$detail = Dtscore::whereXh(Auth::user()->xh)
			->where('tjzt', '<', config('constants.score.dconfirmed'))
			->select('xh', 'xm', 'kcxh', 'kcpt', 'kcxz', 'nd', 'xq', 'kh', 'cj1', 'cj2', 'cj3', 'cj4', 'cj5', 'cj6', 'zpcj', 'kszt', 'tjzt');

		// 显示提交状态小于3的补考成绩
		// 2019-11-09：教务处学籍科要求只显示状态2的成绩作为补缓考待确认成绩
		$makeup = Muscore::whereXh(Auth::user()->xh)
			->where('tjzt', '=', config('constants.score.confirmed'))
			->select('xh', 'xm', 'kcxh', 'kcpt', 'kcxz', 'nd', 'xq', 'kh', 'cj1', 'cj2', 'cj3', 'cj4', 'cj5', 'cj6', 'zpcj', 'kszt', 'tjzt');

		$scores = $detail->union($makeup)
			->orderBy('nd', 'desc')
			->orderBy('xq', 'desc')
			->get();

		$ratios = $this->_arrangeScores($scores);

		return view('score.show')->withTitle('待确认成绩单')->withRatios($ratios);
	}

	/**
	 * 显示学生国家考试成绩单
	 * @author FuRongxin
	 * @date    2016-01-28
	 * @version 2.0
	 * @return  \Illuminate\Http\Response 学生成绩单
	 */
	public function exam() {
		$scores = Exscore::whereC_xh(Auth::user()->xh)
			->orderBy('c_kssj', 'desc')
			->orderBy('c_kslx', 'asc')
			->get();

		return view('score.exam')->withTitle('国家考试成绩单')->withScores($scores);
	}

	/**
	 * 将成绩转换成按成绩比例方式排列
	 * @author FuRongxin
	 * @date    2016-01-27
	 * @version 2.0
	 * @param   array $scores 学生成绩
	 * @return  array 按成绩比例方式排列的成绩
	 */
	private function _arrangeScores($scores) {
		$ratios = [];
		foreach ($scores as $score) {
			if (is_null($score->task)) {
				$ratios['000'] = [
					['id' => '1', 'name' => '成绩1'],
					['id' => '2', 'name' => '成绩2'],
					['id' => '3', 'name' => '成绩3'],
					['id' => '4', 'name' => '成绩4'],
					['id' => '5', 'name' => '成绩5'],
					['id' => '6', 'name' => '成绩6'],
				];
				$ratios['000']['score'][] = $score;
			} else {
				if (!array_key_exists($score->task->cjfs, $ratios)) {
					$items = Ratio::whereFs($score->task->cjfs)->orderBy('id')->get();
					foreach ($items as $ratio) {
						$ratios[$ratio->fs][] = [
							'id'    => $ratio->id,
							'name'  => $ratio->idm,
							'value' => $ratio->bl,
						];
					}
				}
				$ratios[$score->task->cjfs]['score'][] = $score;
			}
		}
		ksort($ratios);

		return $ratios;
	}
}
