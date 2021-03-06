<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Setting;
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

		return view('profile.index')
			->withTitle('个人资料')
			->withProfile($profile)
			->withAllowed($this->allowUploadFile());
	}

	/**
	 * 显示上传照片表单
	 * @author FuRongxin
	 * @date    2016-02-13
	 * @version 2.0
	 * @return  \Illuminate\Http\Response 上传照片表单
	 */
	public function showUpfileForm() {
		if ($this->allowUploadFile()) {
			$exists = Storage::exists(config('constants.file.path.portrait') . Auth::user()->profile->sfzh . '.' . config('constants.file.image.ext'));

			return view('profile.upload')
				->withTitle(' 上传照片')
				->withExists($exists)
				->withStatus(Auth::user()->zpzt);
		}

		abort(403, '不允许上传照片');
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
		if ($this->allowUploadFile()) {
			if ($request->isMethod('post') && $request->hasFile('file')) {
				$this->validate($request, [
					'file' => 'required|image',
				]);

				if ($request->file('file')->isValid()) {
					$file     = $request->file('file');
					$filename = config('constants.file.path.portrait') . Auth::user()->profile->sfzh . '.' . config('constants.file.image.ext');
					$image    = Image::make($file)
						->resize(config('constants.file.image.width'), config('constants.file.image.height'))
						->encode(config('constants.file.image.ext'), config('constants.file.image.quality'));
					Storage::put($filename, $image->stream());

					$user       = Auth::user();
					$user->zpzt = config('constants.file.status.uploaded');
					$user->save();

					return redirect('profile')->withStatus('上传照片成功');
				}
			}

			abort(404, '没有照片');
		}

		abort(403, '不允许上传照片');
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

			return response($file)->header('Content-Type', Storage::mimeType($filename));
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
		$filename = config('constants.file.path.photo') . Auth::user()->xh . '.' . config('constants.file.image.ext');

		if (Storage::exists($filename)) {
			$file = Storage::get($filename);

			return response($file)->header('Content-Type', Storage::mimeType($filename));
		}

		abort(404, '没有照片');
	}

	/**
	 * 是否允许上传照片
	 * @author FuRongxin
	 * @date    2016-02-14
	 * @version 2.0
	 * @return  boolean true为允许，false为禁止
	 */
	private function allowUploadFile() {
		return config('constants.status.enable') == Setting::find('KS_PHOTO_UP')->value;
	}

}
