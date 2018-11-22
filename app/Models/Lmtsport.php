<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 公体课限制
 *
 * @author FuRongxin
 * @date 2018-09-12
 * @version 2.3
 */
class Lmtsport extends Model {

	protected $table = 'xk_gtxz';

	protected $primaryKey = 'nj';

	public $incrementing = false;

	public $timestamps = false;
}
