<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Auth;

/**
 * 显示并处理个人资料
 *
 * @author FuRongxin
 * @date 2016-01-12
 * @version 2.0
 */
class ProfileController extends Controller {

	/**
	 * 显示个人资料列表
	 * @author FuRongxin
	 * @date    2016-01-12
	 * @version 2.0
	 * @return  \Illuminate\Http\Response 个人资料列表
	 */
	public function index() {
		$profile = Profile::find(Auth::user()->xh);

		return view('profile.index')->withTitle('个人资料')->withProfile($profile);
	}

	/**
	 * 显示上传照片表单
	 * @author FuRongxin
	 * @date    2016-02-13
	 * @version 2.0
	 * @return  \Illuminate\Http\Response 上传照片表单
	 */
	public function showUpfileForm() {
		return view('profile.upload')->withTitle(' 上传照片');
	}

	/**
	 * 上传照片
	 * @author FuRongxin
	 * @date    2016-02-13
	 * @version 2.0
	 * @param   \Illuminate\Http\Request $request 上传照片请求
	 * @return  \Illuminate\Http\Response 上传照片表单
	 */
	public function upload(Request $request) {
		if ($request->hasFile('file')) {
			$this->validate($request->only('file'), [
				'image' => 'required',
			]);

			if ($request->file('file')->isValid()) {
				$file      = $request->file('file');
				$extension = $file->getClientOriginalExtension();
				Storage::put(Auth::user()->profile->xfzh . '.' . $extension, file_get_contents($request->file('file')->getRealPath()));

				return redirect('upfile')->withStatus('上传照片成功');
			}
		}
	}

}
