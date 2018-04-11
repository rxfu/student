<?php

namespace App\Models;

use App\Models\DcxmModel;

/**
 * 大创项目系统参数
 *
 * @author FuRongxin
 * @date 2018-03-28
 * @version 2.3
 */
class Dcxmxt extends DcxmModel {

	protected $table = 'dc_xt';

	protected $primaryKey = 'id';

	public $incrementing = false;

	public $timestamps = false;

}
