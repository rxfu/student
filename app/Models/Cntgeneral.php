<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 通识素质课学分统计表
 *
 * @author FuRongxin
 * @date 2017-05-29
 * @version 2.1.7
 */
class Cntgeneral extends Model {

	protected $table = 'xk_tsxftj';

	protected $primaryKey = 'xh';

	public $incrementing = false;

	public $timestamps = false;
}
