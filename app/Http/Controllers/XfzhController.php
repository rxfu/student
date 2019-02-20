<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Score;
use App\Models\Xfzhkc;
use App\Models\Xfzhsq;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class XfzhController extends Controller {

	public function list() {
		$items = Xfzhsq::orderBy('sqsj', 'desc')->get();
		$title = '学分转换申请列表';

		return view('xfzh.list', compact('items', 'title'));
	}

	public function create() {
		$studied_courses = Score::with('course', 'platform', 'property')
			->whereXh(Auth::user()->xh)
			->where('xf', '<>', 0)
			->whereNotIn('kch', function ($query) {
				$query->from('xk_xfzhkc')
					->join('xk_xfzhsq', function ($join) {
						$join->on('appid', '=', 'xk_xfzhsq.id')
							->whereXh(Auth::user()->xh)
							->where(function ($query) {
								$query->where('zt', 0)
									->orWhere('zt', 2)
									->orWhere('zt', 4);
							});
					})
					->select('qkch');
			})
			->get();

		$courses = Plan::with('course', 'platform', 'property')
			->whereZy(Auth::user()->profile->zy)
			->whereNj(Auth::user()->profile->nj)
			->whereZsjj(Auth::user()->profile->zsjj)
			->WhereNotIn('kch', function ($query) {
				$query->from('cj_zxscj')
					->whereXh(Auth::user()->xh)
					->where('xf', '>', 0)
					->select('kch');
			})
			->get();
		$title = "学分转换申请";

		return view('xfzh.create', compact('studied_courses', 'courses', 'title'));
	}

	public function store(Request $request) {
		if ($request->isMethod('post')) {
			$this->validate($request, [
				'xnqkch'  => 'required_without_all:xwqkcmc,xwqcj',
				'xwqkcmc' => 'required_without:xnqkch',
				'xwqcj'   => 'required_without:xnqkch',
				'kch'     => 'required',
			]);

			$kch  = $request->input('kch');
			$plan = Plan::with('course')
				->whereZy(Auth::user()->profile->zy)
				->whereNj(Auth::user()->profile->nj)
				->whereZsjj(Auth::user()->profile->zsjj)
				->whereKch($kch)
				->firstOrFail();

			if ($request->has('xnqkch')) {
				$qkchs  = $request->input('xnqkch');
				$exists = Score::whereXh(Auth::user()->xh)
					->whereIn('kch', $qkchs)
					->wherePt($plan->pt)
					->whereKcxz($plan->xz)
					->exists();

				if ($exists) {
					return back()->withStatus('课程平台和性质都相同，不可以申请学分转换');
				}
			}

			if ($request->has('xwqkcmc') && $request->has('xwqcj')) {
				$names  = $request->input('xwqkcmc');
				$scores = $request->input('xwqcj');

				for ($i = 0; $i < count($names); ++$i) {
					if (!is_null($names[$i]) && is_null($scores[$i]) || is_null($names[$i]) && !is_null($scores[$i])) {
						return back()->withStatus('课程名称和成绩填写不一致，不可以申请学分转换');
					}
				}
			}

			$zhsq       = new Xfzhsq;
			$zhsq->xh   = Auth::user()->xh;
			$zhsq->xm   = Auth::user()->profile->xm;
			$zhsq->sqsj = Carbon::now();
			$zhsq->zt   = 0;
			$zhsq->save();

			if ($request->has('xnqkch')) {
				foreach ($qkchs as $qkch) {
					$score = Score::with('course')
						->whereXh(Auth::user()->xh)
						->whereKch($qkch)
						->firstOrFail();

					$course        = new Xfzhkc;
					$course->qkch  = $qkch;
					$course->qkcmc = $score->course->kcmc;
					$course->qpt   = $score->pt;
					$course->qxz   = $score->kcxz;
					$course->qxf   = $score->xf;
					$course->qcj   = $score->cj;

					$course->kch  = $kch;
					$course->kcmc = $plan->course->kcmc;
					$course->pt   = $plan->pt;
					$course->xz   = $plan->xz;

					$course->sfxw = 0;

					$zhsq->courses()->save($course);
				}
			} elseif ($request->has('xwqkcmc') && $request->has('xwqcj')) {
				for ($i = 0; $i < count($names); ++$i) {
					if (!is_null($names[$i]) && !is_null($scores[$i])) {
						$course        = new Xfzhkc;
						$course->qkcmc = $names[$i];
						$course->qcj   = $scores[$i];

						$course->kch  = $kch;
						$course->kcmc = $plan->course->kcmc;
						$course->pt   = $plan->pt;
						$course->xz   = $plan->xz;

						$course->sfxw = 1;

						$zhsq->courses()->save($course);
					}
				}
			}

			return redirect('xfzh/list')->withStatus('学分转换申请成功');
		}
	}

	public function delete(Request $request, $id) {
		if ($request->isMethod('delete')) {
			$zhsq = Xfzhsq::findOrFail($id);

			$zhsq->delete();

			return back()->withStatus('撤销学分转换申请成功');
		}
	}
}
