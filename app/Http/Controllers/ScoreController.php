<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Dtscore;
use App\Models\Muscore;
use App\Models\Ratio;
use App\Models\Score;
use Auth;

/**
 * 学生成绩单
 *
 * @author FuRongxin
 * @date 2016-01-25
 * @version 2.0
 */
class ScoreController extends Controller {

	/**
	 * 显示并处理学生综合成绩单
	 * @author FuRongxin
	 * @date    2016-01-25
	 * @version 2.0
	 * @return  \Illuminate\Http\Response 学生成绩单
	 */
	public function index() {
		$scores = Score::whereXh(Auth::user()->xh)
			->orderBy('nd', 'desc')
			->orderBy('xq', 'desc')
			->get();

		return view('score.index')->withTitle('综合成绩单')->withScores($scores);
	}

	/**
	 * 显示并处理学生详细成绩单
	 * @author FuRongxin
	 * @date    2016-01-25
	 * @version 2.0
	 * @param   string $kch 8位课程号
	 * @return  \Illuminate\Http\Response 学生成绩单
	 */
	public function show($kch) {

		// 过程成绩
		$scores = Dtscore::detailScore(Auth::user(), $kch)
			->orderBy('nd', 'desc')
			->orderBy('xq', 'desc')
			->get();

		// 补考成绩
		$makeupScores = Muscore::makeupScore(Auth::user(), $kch)
			->orderBy('nd', 'desc')
			->orderBy('xq', 'desc')
			->get();

		$scores = $scores->merge($makeupScores);
		$ratios = $this->arrangeScores($scores);

		return view('score.show')->withTitle(Course::find($kch)->kcmc . '课程详细成绩单')->withRatios($ratios);
	}

	/**
	 * 显示并处理学生待确认成绩单
	 * @author FuRongxin
	 * @date    2016-01-27
	 * @version 2.0
	 * @return  \Illuminate\Http\Response 学生成绩单
	 */
	public function unconfirmed() {

		// 显示提交状态小于3的成绩
		$scores = Dtscore::whereXh(Auth::user()->xh)
			->where('tjzt', '<', config('constants.score.dconfirmed'))
			->orderBy('nd', 'desc')
			->orderBy('xq', 'desc')
			->get();

		// 显示提交状态小于3的补考成绩
		$makeupScores = Muscore::whereXh(Auth::user()->xh)
			->where('tjzt', '<', config('constants.score.dconfirmed'))
			->orderBy('nd', 'desc')
			->orderBy('xq', 'desc')
			->get();

		$scores = $scores->merge($makeupScores);
		$ratios = $this->arrangeScores($scores);

		return view('score.show')->withTitle('待确认成绩单')->withRatios($ratios);
	}

	/**
	 * 将成绩转换成按成绩比例方式排列
	 * @author FuRongxin
	 * @date    2016-01-27
	 * @version 2.0
	 * @param   array $scores 学生成绩
	 * @return  array 按成绩比例方式排列的成绩
	 */
	private function arrangeScores($scores) {
		$ratios = [];
		foreach ($scores as $score) {
			if (count($score->task)) {
				if (!array_key_exists($score->task->cjfs, $ratios)) {
					$items = Ratio::whereFs($score->task->cjfs)->get();
					foreach ($items as $ratio) {
						$ratios[$ratio->fs][] = [
							'id'    => $ratio->id,
							'name'  => $ratio->idm,
							'value' => $ratio->bl,
						];
					}
				}
				$ratios[$score->task->cjfs]['score'][] = $score;
			} else {
				$ratios['000'] = [
					['id' => '1', 'name' => '成绩1'],
					['id' => '2', 'name' => '成绩2'],
					['id' => '3', 'name' => '成绩3'],
					['id' => '4', 'name' => '成绩4'],
					['id' => '5', 'name' => '成绩5'],
					['id' => '6', 'name' => '成绩6'],
				];
				$ratios['000']['score'][] = $score;
			}
		}
		ksort($ratios);

		return $ratios;
	}
}
