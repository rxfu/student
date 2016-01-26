<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Dtscore;
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
		$scores = Dtscore::detailScore(Auth::user(), $kch)
			->orderBy('nd', 'desc')
			->orderBy('xq', 'desc')
			->get();

		$ratios = [];
		foreach ($scores as $score) {
			if (!array_key_exists($score->task->cjfs, $ratios)) {
				foreach ($score->task->ratios as $ratio) {
					$ratios[$ratio->fs][$ratio->id] = $ratios['idm'];
				}
			}
			$ratios[$score->task->cjfs]['score'][] = $score;
		}

		return view('score.show')->withTitle('详细成绩单')
			->withRatios($ratios);
	}
}
