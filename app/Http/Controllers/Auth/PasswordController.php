<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class PasswordController extends Controller {

	/*
		    |--------------------------------------------------------------------------
		    | Password Reset Controller
		    |--------------------------------------------------------------------------
		    |
		    | This controller is responsible for handling password reset requests
		    | and uses a simple trait to include this behavior. You're free to
		    | explore this trait and override any methods you wish to tweak.
		    |
	*/

	use ResetsPasswords;

	/**
	 * Create a new password controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('guest', ['except' => ['showChangeForm', 'change']]);
	}

	/**
	 * 显示修改密码表单
	 * @author FuRongxin
	 * @date    2016-01-12
	 * @version 2.0
	 * @return  \Illuminate\Http\Response 修改密码表单
	 */
	public function showChangeForm() {
		return view('auth.change')->withTitle('修改密码');
	}

	/**
	 * 修改密码
	 * @author FuRongxin
	 * @date    2016-01-12
	 * @version 2.0
	 * @param   \Illuminate\Http\Request $request 表单请求
	 * @return  \Illuminate\Http\Response  修改密码表单
	 */
	public function change(Request $request) {
		$this->validate($request, [
			'old_password'          => 'required',
			'password'              => 'required|min:6|confirmed',
			'password_confirmation' => 'required|min:6',
		]);

		list($old, $password, $confirm) = array_values($request->only('old_password', 'password', 'password_confirmation'));

		$user = Auth::user();
		if (Auth::attempt(['xh' => $user->xh, 'mm' => $old])) {
			if ($password === $confirm && mb_strlen($password) >= 6) {
				$user->mm = $password;
				$user->save();

				return redirect('password/change')->withStatus('修改密码成功');
			}
		}
		dd(['xh' => $user->xh, 'mm' => $old]);
		return redirect()->back()
			->withInput($request->only('old_password'))
			->withErrors(['old_password' => '修改密码失败']);
	}
}
