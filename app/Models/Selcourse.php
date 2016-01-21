<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 选课信息
 *
 * @author FuRongxin
 * @date 2016-01-21
 * @version 2.0
 */
class Selcourse extends Model {

	protected $table = 'xk_xkxx';

	protected $primaryKey = 'xh';

	public $incrementing = false;

	public $timestamps = false;

}
