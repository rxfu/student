<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 公共体育课程表
 *
 * @author FuRongxin
 * @date 2016-05-12
 * @version 2.1
 */
class Pubsport extends Model {

	protected $table = 'pk_gt';

	protected $primaryKey = 'kcxh';

	public $incrementing = false;

	public $timestamps = false;

}
