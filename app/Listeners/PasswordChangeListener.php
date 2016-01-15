<?php

namespace App\Listeners;

use App\Events\PasswordChange;
use App\Models\Slog;
use Illuminate\Http\Request;

class PasswordChangeListener {

	/**
	 * Request 对象
	 * @var Illuminate\Http\Request
	 */
	protected $request;

	/**
	 * Create the event listener.
	 *
	 * @param Illuminate\Http\Request $request 请求对象
	 * @return void
	 */
	public function __construct(Request $request) {
		$this->request = $request;
	}

	/**
	 * Handle the event.
	 *
	 * @param  PasswordChange  $event
	 * @return void
	 */
	public function handle(PasswordChange $event) {
		$log = new Slog;

		$log->ip   = $this->request->ip();
		$log->czlx = 'chgpwd';

		$log->save();
	}
}
