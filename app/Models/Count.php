<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 选课人数统计
 *
 * @author FuRongxin
 * @date 2016-02-23
 * @version 2.0
 */
class Count extends Model {

	protected $table = 'xk_tj';

	protected $primaryKey = 'kcxh';

	public $incrementing = false;

	public $timestamps = false;
}
