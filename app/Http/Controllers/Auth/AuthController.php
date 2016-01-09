<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Validator;

class AuthController extends Controller {
	/*
		    |--------------------------------------------------------------------------
		    | Registration & Login Controller
		    |--------------------------------------------------------------------------
		    |
		    | This controller handles the registration of new users, as well as the
		    | authentication of existing users. By default, this controller uses
		    | a simple trait to add these behaviors. Why don't you explore it?
		    |
	*/

	use AuthenticatesAndRegistersUsers, ThrottlesLogins;

	/**
	 * Where to redirect users after login / registration.
	 *
	 * @var string
	 */
	protected $redirectTo = '/';

	protected $username = 'username';

	/**
	 * Create a new authentication controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('guest', ['except' => 'logout']);
	}

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator(array $data) {
		return Validator::make($data, [
			'username' => 'required|max:12|unique:xk_xsmm',
			'password' => 'required|confirmed|min:6',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	protected function create(array $data) {
		return User::create([
			'username' => $data['username'],
			'password' => bcrypt($data['password']),
		]);
	}

	/**
	 * Get the failed login response instance.
	 *
	 * @param \Illuminate\Http\Request  $response
	 * @return \Illuminate\Http\Response
	 */
	protected function sendFailedLoginResponse(Request $request) {
		return redirect()->back()
			->withInput($request->only($this->loginUsername()))
			->withErrors([
				$this->loginUsername() => $this->getFailedLoginMessage(),
			]);
	}

	/**
	 * Get the failed login message.
	 *
	 * @return string
	 */
	protected function getFailedLoginMessage() {
		return Lang::has('auth.failed')
		? Lang::get('auth.failed')
		: 'These credentials do not match our records.';
	}

	/**
	 * Get the needed authorization credentials from the request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	protected function getCredentials(Request $request) {
		return [
			'xh' => $request->get($this->loginUsername()),
			'mm' => $request->get('password'),
		];
	}

}
