<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 学生欠费名单
 *
 * @author FuRongxin
 * @date 2016-02-24
 * @version 2.0
 */
class Unpaid extends Model {

	protected $table = 'xk_xsqf';

	protected $primaryKey = 'xh';

	public $incrementing = false;

	public $timestamps = false;
}
