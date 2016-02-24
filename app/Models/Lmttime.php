<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 选课时间限制
 *
 * @author FuRongxin
 * @date 2016-02-24
 * @version 2.0
 */
class Lmttime extends Model {

	protected $table = 'xk_sjxz';

	protected $primaryKey = 'nj';

	public $incrementing = false;

	public $timestamps = false;
}
