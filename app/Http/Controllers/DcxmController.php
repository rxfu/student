<?php

namespace App\Http\Controllers;

use App\Models\Dcxmcy;
use App\Models\Dcxmjf;
use App\Models\Dcxmlb;
use App\Models\Dcxmsq;
use App\Models\Dcxmxx;
use App\Models\Dcyjxk;
use App\Models\Dczdjs;
use App\Models\Profile;
use App\Models\Teacher;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * 显示并处理大创项目西悉尼
 *
 * @author FuRongxin
 * @date 2017-11-22
 * @version 2.3
 */
class DcxmController extends Controller {

	/**
	 * 显示大创项目列表
	 *
	 * @author FuRongxin
	 * @date    2017-11-22
	 * @version 2.3
	 * @return  \Illuminate\Http\Response 大创项目列表
	 */
	public function getList() {
		$projects = Dcxmxx::whereXh(Auth::user()->xh)
			->orderBy('cjsj', 'desc')
			->get();
		$title = '项目申请列表';

		return view('dcxm.list', compact('title', 'projects'));
	}

	/**
	 * 大创项目基本信息
	 *
	 * @author FuRongxin
	 * @date    2017-11-22
	 * @version 2.3
	 * @return  \Illuminate\Http\Response 大创项目基本信息
	 */
	public function getInfo() {
		$categories = Dcxmlb::orderBy('dm')->get();
		$subjects   = Dcyjxk::orderBy('dm')->get();
		$title      = '项目申请';

		return view('dcxm.information', compact('title', 'categories', 'subjects'));
	}

	/**
	 * 保存大创项目基本信息
	 *
	 * @author FuRongxin
	 * @date    2017-11-22
	 * @version 2.3
	 * @param   \Illuminate\Http\Request $request 项目信息请求
	 * @return  \Illuminate\Http\Response 大创项目基本信息
	 */
	public function postInfo(Request $request) {
		if ($request->isMethod('post')) {
			$this->validate($request, [
				'xmmc' => 'required|string|max:100',
				'kssj' => 'required|date',
				'jssj' => 'required|date',
			]);
			$inputs = $request->all();

			$xmxx          = new Dcxmxx;
			$xmxx->xmmc    = $inputs['xmmc'];
			$xmxx->xmlb_dm = $inputs['xmlb_dm'];
			$xmxx->yjxk_dm = $inputs['yjxk_dm'];
			$xmxx->xh      = Auth::user()->xh;
			$xmxx->kssj    = $inputs['kssj'];
			$xmxx->jssj    = $inputs['jssj'];
			$xmxx->sfsh    = config('constants.status.disable');
			$xmxx->sftg    = config('constants.status.disable');
			$xmxx->cjsj    = Carbon::now();

			$xmxx->save();

			// 项目组成员
			$i       = 0;
			$members = [];
			foreach ($inputs['cypm'] as $key => $value) {
				if (!empty($inputs['xh'][$key])) {
					$member       = new Dcxmcy;
					$member->xh   = $inputs['xh'][$key];
					$member->xm   = $inputs['cyxm'][$key];
					$member->nj   = $inputs['nj'][$key];
					$member->szyx = $inputs['szyx'][$key];
					$member->lxdh = $inputs['cylxdh'][$key];
					$member->fg   = $inputs['fg'][$key];
					$member->sfbx = ('true' === $inputs['cysfbx'][$key]) ? true : false;
					$member->pm   = ++$i;

					$members[] = $member;
				}
			}

			// 指导教师
			$i      = 0;
			$tutors = [];
			foreach ($inputs['jspm'] as $key => $value) {
				if (!empty($inputs['jsgh'][$key])) {
					$tutor        = new Dczdjs;
					$tutor->jsgh  = $inputs['jsgh'][$key];
					$tutor->xm    = $inputs['jsxm'][$key];
					$tutor->zc    = $inputs['zc'][$key];
					$tutor->szdw  = $inputs['szdw'][$key];
					$tutor->lxdh  = $inputs['jslxdh'][$key];
					$tutor->email = $inputs['email'][$key];
					$tutor->sfbx  = ('true' === $inputs['jssfbx'][$key]) ? true : false;
					$tutor->pm    = ++$i;

					$tutors[] = $tutor;
				}
			}

			$project       = Dcxmxx::find($xmxx->id);
			$project->jsgh = $inputs['jsgh'][0];
			$project->save();
			$project->members()->saveMany($members);
			$project->tutors()->saveMany($tutors);

			return redirect('dcxm/list')->withStatus('项目信息保存成功');
		}
	}

	/**
	 * 编辑项目基本信息
	 *
	 * @author FuRongxin
	 * @date    2017-12-21
	 * @version 2.3
	 * @return  \Illuminate\Http\Response 大创项目基本信息
	 */
	public function getEditInfo($id) {
		$categories = Dcxmlb::orderBy('dm')->get();
		$subjects   = Dcyjxk::orderBy('dm')->get();
		$project    = Dcxmxx::find($id);
		$members    = $project->members()->get();
		$tutors     = $project->tutors()->get();
		$title      = '编辑项目信息';

		return view('dcxm.edit_information', compact('title', 'id', 'categories', 'subjects', 'project', 'members', 'tutors'));
	}

	/**
	 * 编辑项目基本信息
	 *
	 * @author FuRongxin
	 * @date    2017-12-21
	 * @version 2.3
	 * @param   \Illuminate\Http\Request $request 项目申请修改请求
	 * @return  \Illuminate\Http\Response 大创项目基本信息
	 */
	public function postEditInfo(Request $request, $id) {
		if ($request->isMethod('post')) {
			$this->validate($request, [
				'xmmc' => 'required|string|max:100',
				'kssj' => 'required|date',
				'jssj' => 'required|date',
			]);
			$inputs = $request->all();

			$xmxx          = Dcxmxx::find($id);
			$xmxx->xmmc    = $inputs['xmmc'];
			$xmxx->xmlb_dm = $inputs['xmlb_dm'];
			$xmxx->yjxk_dm = $inputs['yjxk_dm'];
			$xmxx->xh      = Auth::user()->xh;
			$xmxx->kssj    = $inputs['kssj'];
			$xmxx->jssj    = $inputs['jssj'];
			$xmxx->sfsh    = config('constants.status.disable');
			$xmxx->sftg    = config('constants.status.disable');
			$xmxx->cjsj    = Carbon::now();

			$xmxx->save();

			// 项目组成员
			$i       = 0;
			$members = [];
			foreach ($inputs['cypm'] as $key => $value) {
				if (!empty($inputs['xh'][$key])) {
					if ('id' != $inputs['cyid'][$key]) {
						$member = Dcxmcy::find($inputs['cyid'][$key]);
					} else {
						$member = new Dcxmcy;
					}

					$member->xh   = $inputs['xh'][$key];
					$member->xm   = $inputs['cyxm'][$key];
					$member->nj   = $inputs['nj'][$key];
					$member->szyx = $inputs['szyx'][$key];
					$member->lxdh = $inputs['cylxdh'][$key];
					$member->fg   = $inputs['fg'][$key];
					$member->sfbx = ('true' === $inputs['cysfbx'][$key]) ? true : false;
					$member->pm   = ++$i;

					$members[] = $member;
				}
			}

			// 指导教师
			$i      = 0;
			$tutors = [];
			foreach ($inputs['jspm'] as $key => $value) {
				if (!empty($inputs['jsgh'][$key])) {
					if ('id' != $inputs['jsid'][$key]) {
						$tutor = Dczdjs::find($inputs['jsid'][$key]);
					} else {
						$tutor = new Dczdjs;
					}

					$tutor->jsgh  = $inputs['jsgh'][$key];
					$tutor->xm    = $inputs['jsxm'][$key];
					$tutor->zc    = $inputs['zc'][$key];
					$tutor->szdw  = $inputs['szdw'][$key];
					$tutor->lxdh  = $inputs['jslxdh'][$key];
					$tutor->email = $inputs['email'][$key];
					$tutor->sfbx  = ('true' === $inputs['jssfbx'][$key]) ? true : false;
					$tutor->pm    = ++$i;

					$tutors[] = $tutor;
				}
			}

			$project       = Dcxmxx::find($xmxx->id);
			$project->jsgh = $inputs['jsgh'][0];
			$project->save();
			$project->members()->saveMany($members);
			$project->tutors()->saveMany($tutors);

			return redirect('dcxm/list')->withStatus('项目信息保存成功');
		}
	}

	/**
	 * 删除大创项目
	 *
	 * @author FuRongxin
	 * @date    2017-12-29
	 * @version 2.3
	 * @param  \Illuminate\Http\Request  $request 删除请求
	 * @param   string $id 项目ID
	 * @return  \Illuminate\Http\Response 大创项目列表
	 */
	public function deleteDeleteInfo($id) {
		if ($request->isMethod('delete')) {
			$project = Dcxmxx::findOrFail($id);
			$project->delete();

			return back()->withStatus('删除项目成功');
		}
	}

	/**
	 * 大创项目申请
	 *
	 * @author FuRongxin
	 * @date    2017-11-22
	 * @version 2.3
	 * @param   $id 项目ID
	 * @return  \Illuminate\Http\Response 大创项目列表
	 */
	public function getApplication($id) {
		$project = Dcxmxx::with('application')->findOrFail($id);
		$title   = '项目' . $project->xmmc . '申报书';

		return view('dcxm.application', compact('title', 'project'));
	}

	/**
	 * 大创项目申请
	 *
	 * @author FuRongxin
	 * @date    2017-11-22
	 * @version 2.3
	 * @param   $id 项目ID
	 * @param   \Illuminate\Http\Request $request 项目申请请求
	 * @return  \Illuminate\Http\Response 大创项目列表
	 */
	public function postApplication(Request $request, $id) {
		if ($request->isMethod('post')) {
			$project = Dcxmxx::whereId($id)
				->whereXh(Auth::user()->xh);

			if ($project->exists()) {
				$project = $project->first();

				if (Dcxmsq::whereXmId($id)->exists()) {
					$xmsq = Dcxmsq::findOrFail($id);
				} else {
					$xmsq = new Dcxmsq;
				}

				$xmsq->xm_id = $project->id;
				$xmsq->xmjj  = $request->xmjj;
				$xmsq->sqly  = $request->sqly;
				$xmsq->xmfa  = $request->xmfa;
				$xmsq->tscx  = $request->tscx;
				$xmsq->jdap  = $request->jdap;

				if ($request->hasFile('zmcl')) {
					$this->validate($request, [
						'zmcl' => 'file',
					]);

					if ($request->file('zmcl')->isValid()) {
						$file     = $request->file('zmcl');
						$content  = file_get_contents($file->getRealPath());
						$filename = config('constants.file.path.dcxm') . Auth::user()->xh . time() . '.' . $file->extension();

						Storage::put($filename, $content);

						$xmsq->zmcl = $filename;
					}
				}

				if ($xmsq->save()) {
					return redirect('dcxm/xmjf/' . $id)->withStatus('填写申报书成功');
				} else {
					return back()->withStatus('填写申报书失败');
				}
			} else {
				return redirect('dcxm/list');
			}
		}
	}

	/**
	 * 大创项目经费计划
	 *
	 * @author FuRongxin
	 * @date    2018-01-25
	 * @version 2.3
	 * @param   $id 项目ID
	 * @return  \Illuminate\Http\Response 大创项目列表
	 */
	public function getFund($id) {
		$project = Dcxmxx::with('funds')->findOrFail($id);
		$funds   = $project->funds()->get();
		$title   = '项目' . $project->xmmc . '经费使用计划';

		return view('dcxm.fund', compact('title', 'project', 'funds'));
	}

	/**
	 * 大创项目经费计划
	 *
	 * @author FuRongxin
	 * @date    2018-01-25
	 * @version 2.3
	 * @param   $id 项目ID
	 * @param   \Illuminate\Http\Request $request 经费填报请求
	 * @return  \Illuminate\Http\Response 大创项目列表
	 */
	public function postFund(Request $request, $id) {
		if ($request->isMethod('post')) {
			$this->validate($request, [
				'kzkm.*' => 'required|string|max:50',
				'je.*'   => 'required|integer',
				'yt.*'   => 'required|string',
			]);

			$inputs = $request->all();

			$project = Dcxmxx::findOrFail($id);

			foreach ($inputs['je'] as $key => $value) {
				if ('id' != $inputs['jfid'][$key]) {
					$fund       = Dcxmjf::find($inputs['jfid'][$key]);
					$fund->gxsj = Carbon::now();
				} else {
					$fund       = new Dcxmjf;
					$fund->cjsj = Carbon::now();
				}

				$fund->xm_id = $project->id;
				$fund->kzkm  = $inputs['kzkm'][$key];
				$fund->je    = $inputs['je'][$key];
				$fund->yt    = $inputs['yt'][$key];

				$fund->save();
			}

			$updated = Dcxmjf::whereXmId($project->id)->get();
			$delIds  = array_diff($updated->pluck('id')->all(), $inputs['jfid']);
			Dcxmjf::destroy($delIds);

			return redirect('dcxm/list')->withStatus('项目经费计划保存成功');
		}
	}

	/**
	 * 获取项目成员信息
	 *
	 * @author FuRongxin
	 * @date    2017-12-03
	 * @version 2.3
	 * @param   \Illuminate\Http\Request $request 项目成员获取请求
	 * @return  \Illuminate\Http\Response 项目成员信息
	 */
	public function getStudent(Request $request) {
		if ($request->isMethod('get')) {
			$exists = Profile::whereXh($request->input('xh'))->exists();

			$student = [
				'xh'   => '',
				'xm'   => '',
				'nj'   => '',
				'szyx' => '',
				'lxdh' => '',
			];
			if ($exists) {
				$profile = Profile::find($request->input('xh'));

				$student['xh']   = $profile->xh;
				$student['xm']   = $profile->xm;
				$student['nj']   = $profile->nj;
				$student['szyx'] = $profile->college->mc;
				$student['lxdh'] = $profile->lxdh;
			} else {
				$student['xm'] = '查无此人';
			}

			return json_encode($student);
		}
	}

	/**
	 * 获取指导教师信息
	 *
	 * @author FuRongxin
	 * @date    2017-12-03
	 * @version 2.3
	 * @param   \Illuminate\Http\Request $request 指导教师获取请求
	 * @return  \Illuminate\Http\Response 指导教师信息
	 */
	public function getTeacher(Request $request) {
		if ($request->isMethod('get')) {
			$exists = Teacher::whereJsgh($request->input('jsgh'))->exists();

			$teacher = [
				'jsgh'  => '',
				'xm'    => '',
				'zc'    => '',
				'szdw'  => '',
				'lxdh'  => '',
				'email' => '',
			];
			if ($exists) {
				$profile = Teacher::find($request->input('jsgh'));

				$teacher['jsgh']  = $profile->jsgh;
				$teacher['xm']    = $profile->xm;
				$teacher['zc']    = $profile->position->mc;
				$teacher['szdw']  = $profile->department->mc;
				$teacher['lxdh']  = $profile->lxdh;
				$teacher['email'] = $profile->email;
			} else {
				$teacher['xm'] = '查无此人';
			}

			return json_encode($teacher);
		}
	}

	/**
	 * 下载证明材料
	 * @author FuRongxin
	 * @date    2018-01-18
	 * @version 2.3
	 * @return  \Illuminate\Http\Response 证明材料
	 */
	public function getFile($id) {
		$xmsq     = Dcxmsq::findOrFail($id);
		$filename = $xmsq->zmcl;

		if (Storage::exists($filename)) {
			$file = Storage::get($filename);

			return response()->download(storage_path('uploads/' . $filename));
		}
	}
}
