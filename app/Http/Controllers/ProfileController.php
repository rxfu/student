<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Auth;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Storage;

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
			$this->validate($request, [
				'file' => 'required|image',
			]);

			if ($request->file('file')->isValid()) {
				$file     = $request->file('file');
				$filename = config('constants.file.path.portrait') . Auth::user()->profile->sfzh . '.' . config('constants.file.image.ext');
				$image    = Image::make($file)->resize(config('constants.file.image.width'), config('constants.file.image.height'))->encode(config('constants.file.image.ext'), config('constants.file.image.quality'));
				Storage::put($filename, $image->stream());

				return redirect('profile/upfile')->withStatus('上传照片成功');
			}
		}

		abort(404, '没有文件');
	}

	/**
	 * 显示考试照片
	 * @author FuRongxin
	 * @date    2016-02-14
	 * @version 2.0
	 * @return  \Illuminate\Http\Response 考试照片
	 */
	public function portrait() {
		$filename = config('constants.file.path.portrait') . Auth::user()->profile->sfzh . '.' . config('constants.file.image.ext');

		if (Storage::exists($filename)) {
			$file = Storage::get($filename);

			return response($file)->header('Content-Type', config('constants.file.image.mime'));
		}

		abort(404, '没有照片');
	}

	/**
	 * 显示学历照片
	 * @author FuRongxin
	 * @date    2016-02-14
	 * @version 2.0
	 * @return  \Illuminate\Http\Response 学历照片
	 */
	public function photo() {
		$filename = config('constants.file.path.photo') . Auth::user()->profile->sfzh . '.' . config('constants.file.image.ext');

		if (Storage::exists($filename)) {
			$file = Storage::get($filename);

			return response($file)->header('Content-Type', config('constants.file.image.mime'));
		}

		abort(404, '没有照片');
	}

}
