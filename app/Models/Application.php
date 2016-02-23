<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 选课申请表
 *
 * @author FuRongxin
 * @date 2016-02-23
 * @version 2.0
 */
class Application extends Model {

	protected $table = 'xk_xksq';

	protected $primaryKey = 'xh';

	public $incrementing = false;

	public $timestamps = false;
}
