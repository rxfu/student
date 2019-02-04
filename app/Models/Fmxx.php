<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fmxx extends Model {

	public $table = 'xs_fmxx';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'xh', 'xm', 'zjlx', 'zjhm', 'rxrq', 'xjzt', 'fmxm1', 'fmzjlx1', 'fmzjhm1', 'fmxm2', 'fmzjlx2', 'fmzjhm2',
	];
}
