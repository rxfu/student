<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Fresh;
use App\Models\Setting;
use Auth;
use Illuminate\Http\Request;

/**
 * 显示并处理新生信息
 *
 * @author FuRongxin
 * @date 2016-02-06
 * @version 2.0
 */
class FreshController extends Controller {

	/**
	 * 显示新生信息填报表
	 * @author FuRongxin
	 * @date    2016-02-06
	 * @version 2.0
	 * @param  string  $xh 12位学号
	 * @return \Illuminate\Http\Response
	 */
	public function edit($xh) {
		if ($this->allowUpdate()) {
			if (Auth::user()->xh === $xh) {
				$profile = Fresh::find($xh);

				return view('fresh.edit')
					->withTitle('新生信息核对')
					->withStatus('初次登录请务必修改密码，若密码忘记请联系年级辅导员初始化。')
					->withProfile($profile);
			}

			abort(404, '学号不匹配');
		}

		abort(403, '不允许填报信息');
	}

	/**
	 * 更新新生籍贯、家长姓名、家庭地址、联系电话等信息
	 * @author FuRongxin
	 * @date    2016-02-06
	 * @version 2.0
	 * @param  \Illuminate\Http\Request  $request
	 * @param  string  $xh 12位学号
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $xh) {
		if ($this->allowUpdate()) {
			if ($request->isMethod('put')) {
				if (Auth::user()->xh === $xh) {
					$this->validate($request, [
						'jg'   => 'required',
						'jzxm' => 'required',
						'jtdz' => 'required',
						'hcdz' => 'required',
					]);

					$user = Fresh::findOrFail($xh);
					$user->fill($request->all());
					if ($user->save()) {
						return redirect()->route('fresh.edit', [$user])->withStatus('更新成功');
					} else {
						return back()->withErrors()->withInput();
					}
				}
			}

			abort(404, '学号不匹配');
		}

		abort(103, '不允许填报信息');
	}

	/**
	 * 是否允许新生填报信息
	 * @author FuRongxin
	 * @date    2016-02-15
	 * @version 2.0
	 * @return  boolean true为允许，false为禁止
	 */
	private function allowUpdate() {
		return Fresh::whereXh(Auth::user()->xh)->exists() && config('constants.status.enable') == Setting::find('XS_XSXX_KG')->value;
	}

}
