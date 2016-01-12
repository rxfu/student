<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 系统消息
 *
 * @author FuRongxin
 * @date 2016-1-12
 * @version 2.0
 */
class Broadcast extends Model {

	protected $table = 'xt_message';

	public $incrementing = false;

	public $timestatmps = false;
}
