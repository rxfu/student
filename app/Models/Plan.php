<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 教学计划
 *
 * @author FuRongxin
 * @date 2016-01-20
 * @version 2.0
 */
class Plan extends Model {

	protected $table = 'jx_jxjh';

	protected $primaryKey = 'kch';

	public $incrementing = false;

	public $timestamps = false;
}
