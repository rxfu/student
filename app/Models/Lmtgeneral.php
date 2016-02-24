<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 通识素质课限制
 *
 * @author FuRongxin
 * @date 2016-02-24
 * @version 2.0
 */
class Lmtgeneral extends Model {

	protected $table = 'xk_tsxz';

	protected $primarykey = 'nj';

	public $incrementing = false;

	public $timestamps = false;
}
